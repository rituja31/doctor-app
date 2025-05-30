<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Time Slot</title>
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
            margin-bottom: 15px;
            color: #2d3748;
        }
        
        .service-info {
            text-align: center;
            margin-bottom: 25px;
            font-size: 16px;
        }
        
        .service-info strong {
            font-weight: 600;
        }
        
        .time-slots {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .time-slot {
            display: flex;
            align-items: center;
        }
        
        .time-slot input[type="radio"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }
        
        .time-slot label {
            cursor: pointer;
            font-size: 15px;
        }
        
        .divider {
            grid-column: span 2;
            height: 1px;
            background: #e2e8f0;
            margin: 10px 0;
        }
        
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 10px 25px;
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
        
        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
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
            <div class="step active">
                <div class="step-circle">2</div>
                <div>Time</div>
            </div>
            <div class="step">
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
        
        <div class="service-info">
            Below you can find list of available time slots for <strong>{{ $service->name }}</strong> by <strong>{{ $employee->name }}</strong>
        </div>
        
        <p class="required">Select time slot for booking</p>
        
        <form action="{{ route('appointment.store-time') }}" method="POST">
            @csrf
            
            <div class="time-slots">
                @foreach($timeSlots as $index => $slot)
                    <div class="time-slot">
                        <input type="radio" id="time{{ $index + 1 }}" name="appointment_time" value="{{ $slot }}" required>
                        <label for="time{{ $index + 1 }}">{{ $slot }}</label>
                    </div>
                    @if($index == 4)
                        <div class="divider"></div>
                    @endif
                @endforeach
            </div>
            
            <div class="nav-buttons">
                <button type="button" class="btn btn-prev" onclick="window.location.href='{{ route('appointment.page') }}'">
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