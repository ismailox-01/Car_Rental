<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Mail\BookingApproved;
use App\Mail\BookingCancelled;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('user', 'car', 'pickupLocation', 'dropoffLocation');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('booking_number', 'like', '%'.$request->search.'%')
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%'.$request->search.'%'));
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $bookings = $query->latest()->paginate(20)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'car.images', 'pickupLocation', 'dropoffLocation', 'payment');
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $oldStatus = $booking->status;
        $updates = ['status' => $validated['status']];

        if ($validated['status'] === 'confirmed') {
            $updates['confirmed_at'] = now();
            try { Mail::to($booking->user->email)->send(new BookingApproved($booking)); } catch (\Exception $e) {}
        }
        if ($validated['status'] === 'cancelled') {
            $updates['cancelled_at'] = now();
            try { Mail::to($booking->user->email)->send(new BookingCancelled($booking)); } catch (\Exception $e) {}
        }

        $booking->update($updates);

        return back()->with('success', "Booking status updated to {$validated['status']}.");
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted.');
    }
    
}
