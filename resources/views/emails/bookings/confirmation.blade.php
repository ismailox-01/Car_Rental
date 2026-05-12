<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { font-size: 12px; color: #777; margin-top: 30px; text-align: center; }
        .booking-info { background: #f9f9f9; padding: 20px; border-radius: 10px; margin: 20px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Confirmation</h1>
            <p>Car Rental Service</p>
        </div>
        
        <p>Hello {{ $booking->user->name }},</p>
        <p>Thank you for choosing us! Your booking has been successfully placed and is now <strong>{{ $booking->status }}</strong>.</p>
        
        <div class="booking-info">
            <h3 style="margin-top:0;">Booking Details</h3>
            <p><strong>Booking Number:</strong> {{ $booking->booking_number }}</p>
            <p><strong>Vehicle:</strong> {{ $booking->car->brand }} {{ $booking->car->model }} ({{ $booking->car->year }})</p>
            <p><strong>Pickup:</strong> {{ $booking->pickup_date->format('l, F j, Y') }} at {{ $booking->pickupLocation->name }}</p>
            <p><strong>Return:</strong> {{ $booking->return_date->format('l, F j, Y') }} at {{ $booking->dropoffLocation->name }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
        </div>
        
        <p>Please remember to bring your original driver's license and a valid ID for verification at the pickup point.</p>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/bookings/' . $booking->id) }}" class="btn">View My Booking</a>
        </div>
        
        <div class="footer">
            <p>If you have any questions, please contact our support at support@carrental.com</p>
            <p>&copy; {{ date('Y') }} Car Rental. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
