<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PaymentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function show(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);
        
        // Only allow payment if the booking is still pending
        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.history')->with('info', 'This booking has already been processed.');
        }

        $booking->load('car', 'pickupLocation', 'dropoffLocation');
        return view('bookings.payment', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.history')->with('info', 'This booking has already been processed.');
        }

        // Validate the general request
        $validated = $request->validate([
            'payment_method' => 'required|in:card,paypal,cash'
        ]);

        $paymentMethod = $validated['payment_method'];
        $paymentData = null;
        $status = 'paid'; // Default status for card and simulated paypal

        // Handle Card Specifics
        if ($paymentMethod === 'card') {
            $cardValidated = $request->validate([
                'card_name'   => 'required|string',
                'card_number' => 'required|string|min:16',
                'expiry'      => 'required|string',
                'cvc'         => 'required|string|min:3',
            ]);
            $paymentData = [
                'card_name' => $cardValidated['card_name'],
                'last_four' => substr($cardValidated['card_number'], -4)
            ];
        } else if ($paymentMethod === 'paypal') {
            // Simulated PayPal flow
            $paymentData = [
                'provider' => 'paypal',
                'email' => auth()->user()->email
            ];
        } else if ($paymentMethod === 'cash') {
            // Cash on delivery
            $status = 'pending';
        }

        // Create a Payment record
        $payment = Payment::create([
            'booking_id'     => $booking->id,
            'amount'         => $booking->total_price,
            'method'         => $paymentMethod,
            'status'         => $status,
            'transaction_id' => 'SIM_TXN_' . strtoupper(uniqid()),
            'payment_data'   => $paymentData,
            'paid_at'        => $status === 'paid' ? now() : null,
        ]);

        if ($paymentMethod === 'paypal') {
            // Redirect to PayPal Sandbox (Simulated real-world redirect)
            $paypalUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
            $query = http_build_query([
                'cmd' => '_xclick',
                'business' => 'sb-merchant@example.com', // Sandbox business email
                'item_name' => 'Car Rental Booking - ' . $booking->booking_number,
                // Roughly converting MAD to USD for PayPal compatibility
                'amount' => round($booking->total_price / 10, 2), 
                'currency_code' => 'USD',
                'return' => route('bookings.paypal.return', $booking),
                'cancel_return' => route('bookings.payment', $booking),
            ]);
            
            return redirect()->away($paypalUrl . '?' . $query);
        }

        // Update the booking status
        $bookingStatus = $status === 'paid' ? 'confirmed' : 'pending';
        $booking->update([
            'status'       => $bookingStatus,
            'confirmed_at' => $status === 'paid' ? now() : null
        ]);

        if ($status === 'paid') {
            try {
                Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                \Log::error("Mail error: " . $e->getMessage());
            }
        }

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', $status === 'paid' ? 'Payment successful! Your booking is now confirmed.' : 'Request received. Order is pending.');
    }

    public function paypalReturn(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);
        
        $payment = Payment::where('booking_id', $booking->id)->where('method', 'paypal')->latest()->first();
        
        if ($payment && $payment->status !== 'paid') {
            $payment->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
            
            $booking->update([
                'status' => 'confirmed',
                'confirmed_at' => now()
            ]);

            try {
                Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));
            } catch (\Exception $e) {
                \Log::error("Mail error: " . $e->getMessage());
            }
        }

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'PayPal Payment successful! Your booking is now confirmed.');
    }
}

