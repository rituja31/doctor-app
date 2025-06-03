<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        
        .navbar {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .nav-container {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn-dashboard {
            padding: 8px 16px;
            background: #4a6cf7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }
        
        .btn-dashboard:hover {
            background: #3a56d4;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            z-index: 1;
        }
        
        .step {
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .step.active {
            color: #4a6cf7;
        }
        
        .step-circle {
            width: 30px;
            height: 30px;
            background: #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 5px;
            color: white;
        }
        
        .step.active .step-circle {
            background: #4a6cf7;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2d3748;
        }
        
        .confirmation-message {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .confirmation-message h2 {
            color: #38a169;
            margin-bottom: 15px;
        }
        
        .confirmation-message p {
            margin-bottom: 10px;
        }
        
        .highlight {
            color: #4a6cf7;
            font-weight: 600;
        }
        
        .booking-details {
            margin-bottom: 30px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-label {
            font-weight: 600;
            color: #4a5568;
        }
        
        .detail-value {
            font-weight: 500;
        }
        
        .btn-another {
            display: block;
            width: 100%;
            padding: 15px;
            background: #4a6cf7;
            color: white;
            text-align: center;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            text-decoration: none;
        }
        
        .btn-another:hover {
            background: #3a56d4;
        }
        
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
        .step.completed .step-circle {
            background: #48bb78; 
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('patient.dashboard') }}" class="btn-dashboard">Go to Dashboard</a>
            <div></div>
        </div>
    </nav>
    
    <div class="container">
        <div class="progress-steps">
            <div class="step completed">
                <div class="step-circle">1</div>
                <div>Service</div>
            </div>
            <div class="step completed">
                <div class="step-circle">2</div>
                <div>Time</div>
            </div>
            <div class="step completed">
                <div class="step-circle">3</div>
                <div>Details</div>
            </div>
            <div class="step completed">
                <div class="step-circle">4</div>
                <div>Billing</div>
            </div>
            <div class="step completed">
                <div class="step-circle">5</div>
                <div>Done</div>
            </div>
        </div>
        
        <h1>Book Appointment</h1>
        
        <div class="confirmation-message">
            <h2>Thank you! Your Booking is Completed</h2>
            <p>You have successfully booked an appointment</p>
            <p>We'll send booking details via an email to you at <span class="highlight">{{ $finalData['email'] }}</span></p>
        </div>
        
        <div class="booking-details">
            <div class="detail-row">
                <span class="detail-label">Category</span>
                <span class="detail-value">{{ $finalData['category_name'] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service</span>
                <span class="detail-value">{{ $finalData['service_name'] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service Fees</span>
                <span class="detail-value">${{ number_format($finalData['service_fees'], 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Doctor</span>
                <span class="detail-value">{{ $finalData['doctor_name'] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Appointment Date:</span>
                <span class="detail-value">{{ $finalData['appointment_date'] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Appointment Time:</span>
                <span class="detail-value">{{ $finalData['appointment_time'] }}</span>
            </div>
        </div>
        
        <div class="divider"></div>
        
        <a href="{{ route('appointment.page') }}" class="btn-another">Book Another Appointment</a>
    </div>
</body>
</html>