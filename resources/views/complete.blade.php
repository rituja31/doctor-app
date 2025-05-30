<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Appointment</title>
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
            padding: 20px;
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
        
        .notice {
            background: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .details-container {
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
            text-align: right;
        }
        
        .highlight {
            color: #4a6cf7;
            font-weight: 600;
        }
        
        .btn-book {
            width: 100%;
            padding: 15px;
            background: #4a6cf7;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-book:hover {
            background: #3a56d4;
        }
        .step.completed .step-circle {
            background: #48bb78; 
        }
    </style>
</head>
<body>
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
            <div class="step active">
                <div class="step-circle">5</div>
                <div>Done</div>
            </div>
        </div>
        
        <h1>Book Appointment</h1>
        
        <div class="notice">
            Please confirm your appointment booking details once before proceed.
            <br><br>
            We'll send booking details via an email to you at <span class="highlight">{{ $appointment['email'] }}</span>
        </div>
        
        <div class="details-container">
            <div class="detail-row">
                <span class="detail-label">Category</span>
                <span class="detail-value">{{ $category->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service</span>
                <span class="detail-value">{{ $service->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Service Fees</span>
                <span class="detail-value">${{ number_format($appointment['service_fees'], 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Employee</span>
                <span class="detail-value">{{ $employee->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Appointment Date:</span>
                <span class="detail-value">{{ $appointment['appointment_date'] }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Appointment Time:</span>
                <span class="detail-value">{{ $appointment['appointment_time'] }}</span>
            </div>
        </div>
        
        <form action="{{ route('appointment.complete') }}" method="POST">
            @csrf
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <button type="button" style="padding: 10px 25px; background: #e2e8f0; color: #4a5568; border: none; border-radius: 6px; cursor: pointer;" onclick="window.location.href='{{ route('appointment.billing') }}'">
                    < Back to Billing
                </button>
                <button type="submit" style="padding: 10px 25px; background: #4a6cf7; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
</body>
</html>