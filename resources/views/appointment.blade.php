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

        /* Ensure dropdown menus are scrollable if they have many options */
        select {
            /* Modern browsers will automatically add a scrollbar to the dropdown menu if needed */
            -webkit-appearance: menulist; /* Ensure default dropdown behavior in WebKit browsers */
            -moz-appearance: menulist; /* Ensure default dropdown behavior in Firefox */
            appearance: menulist; /* Ensure default dropdown behavior */
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

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-back {
            background: #e2e8f0;
            color: #4a5568;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background: #cbd5e0;
        }

        .btn-next {
            background: #4a6cf7;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
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

        <form action="{{ route('appointment.store') }}" method="POST">
            @csrf
            <div class="form-container">
                <div class="form-group">
                    <label for="category" class="required">Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="service" class="required">Service</label>
                    <select id="service" name="service" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" data-category="{{ $service->category_id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="doctor" class="required">Doctor</label>
                    <select id="doctor" name="doctor" required>
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="appointment_type" class="required">Appointment Type</label>
                    <select id="appointment_type" name="appointment_type" required>
                        <option value="">Select Type</option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date" class="required">Date</label>
                    <input type="date" id="date" name="date" value="{{ $today }}" min="{{ $today }}" required>
                </div>

                <div class="button-group">
                    <button type="button" onclick="window.location.href='{{ route('patient.dashboard') }}'" class="btn-back">< Back</button>
                    <button type="submit" class="btn-next">Next ></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Optional: Add JavaScript to filter services based on selected category
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            const serviceSelect = document.getElementById('service');
            const options = serviceSelect.querySelectorAll('option');

            options.forEach(option => {
                if (option.value === "") {
                    return; // Skip the "Select Service" option
                }
                const optionCategoryId = option.getAttribute('data-category');
                option.style.display = (categoryId === "" || optionCategoryId === categoryId) ? 'block' : 'none';
                if (option.style.display === 'none' && option.selected) {
                    serviceSelect.value = "";
                }
            });
        });
    </script>
</body>
</html>