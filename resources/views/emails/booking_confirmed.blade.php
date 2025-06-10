<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmation</title>
</head>
<body>
    <h1>Hi {{ $booking->name }},</h1>
    <p>Your appointment has been successfully booked.</p>
    <p><strong>Date:</strong> {{ $booking->appointment_date }}</p>
    <p><strong>Time:</strong> {{ $booking->appointment_time }}</p>
    <p>Thank you for choosing us!</p>
</body>
</html>