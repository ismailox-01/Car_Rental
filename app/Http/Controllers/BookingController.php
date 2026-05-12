<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Coupon;
use App\Models\Location;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
// 1. استيراد الكلاسات المطلوبة للـ Middleware في لارافيل 11
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BookingController extends Controller implements HasMiddleware
{
    /**
     * 2. تعريف الـ Middleware بدلاً من الـ Constructor
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // تم حذف الـ __construct() لتجنب الخطأ

    public function create(Request $request)
    {
        $car = Car::with('images')->findOrFail($request->car_id);
        $locations = Location::where('is_active', true)->get();

        // Pass old input to the view if it exists in session
        return view('bookings.create', compact('car', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id'              => 'required|exists:cars,id',
            'pickup_location_id'  => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
            'pickup_date'         => 'required|date|after_or_equal:today',
            'return_date'         => 'required|date|after:pickup_date',
            'extras'              => 'nullable|array',
            'coupon_code'         => 'nullable|string',
            'notes'               => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        if (!$user->id_card_image || !$user->driving_license_image) {
            // Flash input to session so it can be restored
            $request->flash();
            
            return redirect()->route('profile.edit', [
                'return_to' => route('bookings.create', ['car_id' => $validated['car_id']])
            ])->with('warning', 'Please upload your ID Card and Driver\'s License in your profile to complete your booking.');
        }

        $car = Car::findOrFail($validated['car_id']);

        // Check availability
        if (!$car->isAvailableForDates($validated['pickup_date'], $validated['return_date'])) {
            return back()->withErrors(['dates' => 'This car is not available for the selected dates.']);
        }

        $pickupDate = Carbon::parse($validated['pickup_date']);
        $returnDate = Carbon::parse($validated['return_date']);
        $totalDays  = $pickupDate->diffInDays($returnDate);
        if ($totalDays < 1) $totalDays = 1;

        // Calculate extras
        $extrasPrice = 0;
        $extrasItems = [];
        if ($request->has('extras')) {
            $extrasMap = [
                'gps'       => 10,
                'child_seat'=> 15,
                'insurance' => 25,
            ];
            foreach ($request->extras as $extra) {
                if (isset($extrasMap[$extra])) {
                    $extrasItems[$extra] = $extrasMap[$extra];
                    $extrasPrice += $extrasMap[$extra] * $totalDays;
                }
            }
        }

        $subtotal = ($car->price_per_day * $totalDays) + $extrasPrice;
        $discount = 0;

        // Apply coupon
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($subtotal);
                $coupon->increment('used_count');
            }
        }

        $totalPrice = $subtotal - $discount;

        $booking = Booking::create([
            'booking_number'      => Booking::generateBookingNumber(),
            'user_id'             => auth()->id(),
            'car_id'              => $car->id,
            'pickup_location_id'  => $validated['pickup_location_id'],
            'dropoff_location_id' => $validated['dropoff_location_id'],
            'pickup_date'         => $validated['pickup_date'],
            'return_date'         => $validated['return_date'],
            'total_days'          => $totalDays,
            'price_per_day'       => $car->price_per_day,
            'extras_price'        => $extrasPrice,
            'discount'            => $discount,
            'total_price'         => $totalPrice,
            'status'              => 'pending',
            'extras'              => $extrasItems ?: null,
            'coupon_code'         => $request->coupon_code ?? null,
            'notes'               => $request->notes,
        ]);

        // Send confirmation email (Optional - we can move this to after payment)
        try {
            // Mail::to(auth()->user()->email)->send(new BookingConfirmation($booking));
        } catch (\Exception $e) {
            \Log::error("Mail error: " . $e->getMessage());
        }

        return redirect()->route('bookings.payment', $booking)
            ->with('success', 'Booking reserved! Please complete your payment to confirm.');
    }

    public function confirmation(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);
        $booking->load('car.primaryImage', 'pickupLocation', 'dropoffLocation');
        return view('bookings.confirmation', compact('booking'));
    }

    public function history()
    {
        $bookings = auth()->user()->bookings()
            ->with('car.primaryImage', 'pickupLocation', 'dropoffLocation')
            ->latest()
            ->paginate(10);

        return view('bookings.history', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        if (!$booking->canBeCancelled()) {
            return back()->withErrors(['cancel' => 'This booking cannot be cancelled.']);
        }

        $booking->update([
            'status'       => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Booking cancelled successfully.');
    }
   
   public function downloadPdf($id)
    {
    // تحميل بيانات الحجز مع السيارة والعميل
    $booking = Booking::with(['car', 'user'])->findOrFail($id);

    // تواريخ الاستلام والتسليم (للتأكد من الترتيب الصحيح)
    $pickup = \Carbon\Carbon::parse($booking->pickup_date);
    $return = \Carbon\Carbon::parse($booking->return_date);

    // حساب الأيام من قاعدة البيانات مباشرة (total_days)
    $days = $booking->total_days;

    $pdf = Pdf::loadView('pdf.ticket', compact('booking', 'days', 'pickup', 'return'));

    return $pdf->download('reservation_' . $booking->booking_number . '.pdf');
    }
}
