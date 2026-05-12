<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #fecaca; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { font-size: 12px; color: #777; margin-top: 30px; text-align: center; }
        .status-box { background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; text-align: center; font-weight: bold; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #991b1b;">Booking Cancelled</h1>
        </div>
        
        <div class="status-box">
            YOUR BOOKING HAS BEEN CANCELLED
        </div>
        
        <p>Hello {{ $booking->user->name }},</p>
        <p>Your booking <strong>#{{ $booking->booking_number }}</strong> has been cancelled.</p>
        
        <p>If you did not request this cancellation or have any questions about refunds and future bookings, please reach out to our support team immediately.</p>
        
        <p>Vehicle: <strong>{{ $booking->car->brand }} {{ $booking->car->model }}</strong></p>
        <p>Dates: <strong>{{ $booking->pickup_date->format('M d') }} - {{ $booking->return_date->format('M d, Y') }}</strong></p>
        
        <div class="footer">
            <p>We hope to see you again soon.</p>
            <p>&copy; {{ date('Y') }} Car Rental. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
