<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { font-size: 12px; color: #777; margin-top: 30px; text-align: center; }
        .status-box { background: #dcfce7; color: #166534; padding: 15px; border-radius: 10px; text-align: center; font-weight: bold; margin: 20px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Approved!</h1>
        </div>
        
        <div class="status-box">
            YOUR BOOKING HAS BEEN APPROVED
        </div>
        
        <p>Hello {{ $booking->user->name }},</p>
        <p>Great news! Your booking <strong>#{{ $booking->booking_number }}</strong> has been approved by our team. **Now you can come and pick up the car.** We are looking forward to serving you!</p>
        
        <p>Vehicle: <strong>{{ $booking->car->brand }} {{ $booking->car->model }}</strong></p>
        <p>Date: <strong>{{ $booking->pickup_date->format('M d') }} - {{ $booking->return_date->format('M d, Y') }}</strong></p>
        
        <p>You can now view your digital receipt and manage your trip details by clicking the button below.</p>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/bookings/' . $booking->id) }}" class="btn">Manage Booking</a>
        </div>
        
        <div class="footer">
            <p>Safe travels!</p>
            <p>&copy; {{ date('Y') }} Car Rental. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
