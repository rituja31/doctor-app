<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
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
        
        .summary {
            background: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .summary p {
            margin-bottom: 10px;
        }
        
        .summary strong {
            font-weight: 600;
            color: #4a6cf7;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }
        
        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
        }
        
        .row {
            display: flex;
            gap: 15px;
        }
        
        .col {
            flex: 1;
        }
        
        .validation {
            color: #38a169;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
        
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-prev {
            background: #e2e8f0;
            color: #4a5568;
            border: none;
        }
        
        .btn-prev:hover {
            background: #cbd5e0;
        }
        
        .btn-next {
            background: #4a6cf7;
            color: white;
            border: none;
        }
        
        .btn-next:hover {
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
            <div class="step active">
                <div class="step-circle">3</div>
                <div>Details</div>
            </div>
            <div class="step">
                <div class="step-circle">4</div>
                <div>Billing</div>
            </div>
            <div class="step">
                <div class="step-circle">5</div>
                <div>Done</div>
            </div>
        </div>
        
        <h1>Book Appointment</h1>
        
        <div class="summary">
            <p>You've selected <strong>{{ $service->name }}</strong> service from <strong>{{ $appointment['appointment_time'] }}</strong> on <strong>{{ $appointment['appointment_date'] }}</strong>. You'll be charged <strong>₹{{ number_format($appointment['service_fees'], 2) }}</strong>.</p>
            <p>Please provide your details in the form below to proceed with booking.</p>
        </div>
        
        <form action="{{ route('appointment.details.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="required">First Name</label>
                <input type="text" name="first_name" required>
            </div>
            
            <div class="form-group">
                <label class="required">Last Name</label>
                <input type="text" name="last_name" required>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="required">Phone</label>
                        <input type="tel" name="phone" required>
                        <div class="validation"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="required">Email</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Details</label>
                <textarea name="details" rows="3"></textarea>
            </div>
            
            <div class="divider"></div>
            
            <div class="nav-buttons">
                <button type="button" class="btn btn-prev" onclick="window.location.href='{{ route('appointment.time') }}'">
                    < Prev
                </button>
                <button type="submit" class="btn btn-next">
                    Next >
                </button>
            </div>
        </form>
    </div>
</body>
</html>