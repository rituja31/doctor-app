<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }
        
        select, input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        select:focus, input:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
        }
        
        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
        }
        
        .btn-next {
            background: #4a6cf7;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            transition: background 0.3s;
        }
        
        .btn-next:hover {
            background: #3a56d4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="progress-steps">
            <div class="step active">
                <div class="step-circle">1</div>
                <div>Service</div>
            </div>
            <div class="step">
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
        
        <div class="form-container">
            <div class="form-group">
                <label for="category" class="required">Category</label>
                <select id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="1" selected>Hair Services</option>
                    <option value="2">Skin Care</option>
                    <option value="3">Massage</option>
                    <option value="4">Nail Care</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="service" class="required">Service</label>
                <select id="service" name="service">
                    <option value="">Select Service</option>
                    <option value="1" selected>Haircut</option>
                    <option value="2">Coloring</option>
                    <option value="3">Styling</option>
                    <option value="4">Treatment</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="employee" class="required">Employee</label>
                <select id="employee" name="employee">
                    <option value="">Select Employee</option>
                    <option value="1" selected>kevin D'costa</option>
                    <option value="2">Sarah fernandis</option>
                    <option value="3">shruti kamat</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="date" class="required">Date</label>
                <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <button onclick="window.location.href='{{ route('appointment.time') }}'" class="btn-next">Next &gt;</button>
        </div>
    </div>
</body>
</html>