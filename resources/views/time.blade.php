<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Time Slot</title>
    <style>
        /* [Keep all the CSS from the previous time slot implementation] */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="progress-steps">
            <div class="step">
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
            Below you can find list of available time slots for <strong>Tooth Extraction</strong> by <strong>Sanad Sanad</strong>
        </div>
        
        <p class="required">Select time slot for booking</p>
        
        <form action="{{ route('appointment.details') }}" method="GET">
            @csrf
            
            <div class="time-slots">
                <div class="time-slot">
                    <input type="radio" id="time1" name="appointment_time" value="08:00 AM - 08:35 AM" required>
                    <label for="time1">08:00 AM - 08:35 AM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time2" name="appointment_time" value="10:10 AM - 10:45 AM">
                    <label for="time2">10:10 AM - 10:45 AM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time3" name="appointment_time" value="12:30 PM - 01:05 PM">
                    <label for="time3">12:30 PM - 01:05 PM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time4" name="appointment_time" value="02:40 PM - 03:15 PM">
                    <label for="time4">02:40 PM - 03:15 PM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time5" name="appointment_time" value="04:50 PM - 05:25 PM">
                    <label for="time5">04:50 PM - 05:25 PM</label>
                </div>
                
                <div class="divider"></div>
                
                <div class="time-slot">
                    <input type="radio" id="time6" name="appointment_time" value="09:05 AM - 09:40 AM">
                    <label for="time6">09:05 AM - 09:40 AM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time7" name="appointment_time" value="11:15 AM - 11:50 AM">
                    <label for="time7">11:15 AM - 11:50 AM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time8" name="appointment_time" value="01:35 PM - 02:10 PM">
                    <label for="time8">01:35 PM - 02:10 PM</label>
                </div>
                
                <div class="time-slot">
                    <input type="radio" id="time9" name="appointment_time" value="03:45 PM - 04:20 PM">
                    <label for="time9">03:45 PM - 04:20 PM</label>
                </div>
            </div>
            
            <div class="nav-buttons">
                <button type="button" class="btn btn-prev" onclick="window.location.href='{{ route('appointment.page') }}'">
                    &lt; Prev
                </button>
                <button type="submit" class="btn btn-next">
                    Next >
                </button>
            </div>
        </form>
    </div>
</body>
</html>