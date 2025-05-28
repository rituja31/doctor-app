<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
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
            margin-bottom: 30px;
            color: #2d3748;
        }
        
        .payment-header {
            font-weight: 600;
            margin-bottom: 15px;
            color: #4a5568;
        }
        
        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
        }
        
        .payment-section {
            margin-bottom: 25px;
        }
        
        .payment-method {
            display: flex;
            align-items: center;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-method:hover {
            border-color: #4a6cf7;
        }
        
        .payment-method input[type="radio"] {
            margin-right: 15px;
            width: 18px;
            height: 18px;
        }
        
        .payment-method label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            flex-grow: 1;
        }
        
        .payment-method img {
            width: 60px;
            margin-left: 10px;
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
            <div class="step completed">
                <div class="step-circle">3</div>
                <div>Details</div>
            </div>
            <div class="step active">
                <div class="step-circle">4</div>
                <div>Billing</div>
            </div>
            <div class="step">
                <div class="step-circle">5</div>
                <div>Done</div>
            </div>
        </div>
        
        <h1>Book Appointment</h1>
        
        <form action="{{ route('appointment.complete') }}" method="POST">
            @csrf
            
            <div class="payment-header required">Select Payment method</div>
            <div class="divider"></div>
            
            <div class="payment-section">
                <div class="payment-method">
                    <input type="radio" id="stripe" name="payment_method" value="stripe" required>
                    <label for="stripe">
                        Stripe
                        <img src="https://cdn.worldvectorlogo.com/logos/stripe-4.svg" alt="Stripe">
                    </label>
                </div>
                
                <div class="payment-method">
                    <input type="radio" id="razorpay1" name="payment_method" value="razorpay">
                    <label for="razorpay1">
                        Razorpay
                        <img src="{{ asset('images/razorpay_logo.png') }}" alt="Razorpay">
                    </label>
                </div>
            </div>
            
            <div class="divider">other options</div>
            
            <div class="payment-section">
                <div class="payment-method">
                    <input type="radio" id="razorpay2" name="payment_method" value="razorpay2">
                    <label for="razorpay2">
                        Razorpay
                        <img src="{{ asset('images/razorpay_logo.png') }}" alt="Razorpay">
                    </label>
                </div>
                
                <div class="payment-method">
                    <input type="radio" id="pay_later" name="payment_method" value="pay_later">
                    <label for="pay_later">
                        Pay Later
                        <img src="https://cdn-icons-png.flaticon.com/512/477/477103.png" alt="Pay Later" style="width: 30px;">
                    </label>
                </div>
            </div>
            
            <div class="nav-buttons">
                <button type="button" class="btn btn-prev" onclick="window.location.href='{{ route('appointment.details') }}'">
                    &lt; Prev
                </button>
                <button type="submit" class="btn btn-next">
                    Next &gt;
                </button>
            </div>
        </form>
    </div>
</body>
</html>