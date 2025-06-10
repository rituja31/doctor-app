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

        .step.completed .step-circle {
            background: #48bb78;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
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

        select, input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        select:focus, input:focus, textarea:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
        }

        .required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
        }

        .time-slots {
            display: flex;
            flex-direction: column; /* Stack time slots vertically */
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

        .payment-header {
            font-weight: 600;
            margin-bottom: 15px;
            color: #4a5568;
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

        .confirmation-message {
            text-align: center;
            margin-bottom: 30px;
        }

        .confirmation-message h2 {
            color: #38a169;
            margin-bottom: 15px;
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

        .error {
            color: #e53e3e;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Progress Steps -->
        <div class="progress-steps" id="progressSteps">
            <div class="step active" data-step="1">
                <div class="step-circle">1</div>
                <div>Doctor & Date</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-circle">2</div>
                <div>Time</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-circle">3</div>
                <div>Billing</div>
            </div>
            <div class="step" data-step="4">
                <div class="step-circle">4</div>
                <div>Confirm</div>
            </div>
            <div class="step" data-step="5">
                <div class="step-circle">5</div>
                <div>Done</div>
            </div>
        </div>

        <h1>Book Appointment</h1>

        <!-- Form to handle the entire booking process -->
        <form id="bookingForm" action="{{ route('appointment.store') }}" method="POST">
            @csrf

            <!-- Step 1: Doctor, Appointment Type, and Date -->
            <div class="form-step active" id="step-1">
                <div class="form-group">
                    <label for="doctor" class="required">Doctor</label>
                    <select id="doctor" name="doctor" required>
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" 
                                    data-timings="{{ $doctor->timings }}" 
                                    data-category-ids="{{ $doctor->category_id }}" 
                                    data-service-ids="{{ $doctor->service_id }}"
                                    data-specialties="{{ $doctor->specialties }}">
                                {{ $doctor->first_name }} {{ $doctor->last_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="appointment_type" class="required">Appointment Type</label>
                    <select id="appointment_type" name="appointment_type" required>
                        <option value="">Select Type</option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                    @error('appointment_type')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date" class="required">Date</label>
                    <input type="date" id="date" name="date" value="{{ $today }}" min="{{ $today }}" required>
                    @error('date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-prev" onclick="window.location.href='{{ route('patient.dashboard') }}'">< Back</button>
                    <button type="button" class="btn btn-next" onclick="goToStep(2)">Next ></button>
                </div>
            </div>

            <!-- Step 2: Time Slots -->
            <div class="form-step" id="step-2">
                <p class="required">Select time slot for booking</p>
                <div class="time-slots" id="timeSlots">
                    <!-- Time slots will be populated dynamically -->
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-prev" onclick="goToStep(1)">< Prev</button>
                    <button type="button" class="btn btn-next" onclick="goToStep(3)">Next ></button>
                </div>
            </div>

            <!-- Step 3: Billing -->
            <div class="form-step" id="step-3">
                <div class="payment-header required">Select Payment Method</div>
                <div class="divider"></div>

                <div class="payment-section">
                    <div class="payment-method">
                        <input type="radio" id="razorpay" name="payment_method" value="razorpay" required>
                        <label for="razorpay">
                            Razorpay
                            <img src="{{ asset('images/razorpay_logo.png') }}" alt="Razorpay">
                        </label>
                    </div>
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-prev" onclick="goToStep(2)">< Prev</button>
                    <button type="button" class="btn btn-next" onclick="goToStep(4)">Next ></button>
                </div>
            </div>

            <!-- Step 4: Confirmation -->
            <div class="form-step" id="step-4">
                <div class="notice">
                    Please confirm your appointment booking details before proceeding.
                    <br><br>
                    We'll send booking details via an email to you, <span class="highlight">{{ $patientName }}</span>, at <span class="highlight">{{ $patientEmail }}</span>.
                </div>

                <div class="details-container" id="confirmationDetails">
                    <!-- Details will be populated dynamically -->
                </div>

                <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                    <button type="button" class="btn btn-prev" onclick="goToStep(3)">< Back to Billing</button>
                    <button type="button" class="btn btn-next" onclick="goToStep(5)">Book Appointment</button>
                </div>
            </div>

            <!-- Step 5: Final Confirmation -->
            <div class="form-step" id="step-5">
                <div class="confirmation-message">
                    <h2>Thank you! Your Booking is Completed</h2>
                    <p>You have successfully booked an appointment</p>
                    <p>We'll send booking details via an email to you, <span class="highlight">{{ $patientName }}</span>, at <span class="highlight">{{ $patientEmail }}</span>.</p>
                </div>

                <div class="details-container" id="finalDetails">
                    <!-- Details will be populated dynamically -->
                </div>

                <div class="divider"></div>

                <a href="{{ route('appointment.page') }}" class="btn-another">Book Another Appointment</a>
                <a href="{{ route('patient.dashboard') }}" class="btn-another" style="margin-top: 10px;">Back to Dashboard</a>
            </div>

            <!-- Hidden inputs to store data for submission -->
            <input type="hidden" name="category_ids" id="categoryIds">
            <input type="hidden" name="service_ids" id="serviceIds">
            <input type="hidden" name="specialties" id="specialties">
            <input type="hidden" name="appointment_time" id="appointmentTime">
        </form>
    </div>

    <script>
        let currentStep = 1;
        let selectedTimeSlot = ''; // Store the selected time slot globally

        const doctorsData = {};
        @foreach($doctors as $doctor)
            doctorsData[{{ $doctor->id }}] = {
                timings: @json($doctor->timings ? explode(',', $doctor->timings) : []),
                category_ids: @json($doctor->category_id),
                service_ids: @json($doctor->service_id),
                specialties: @json($doctor->specialties),
                name: "{{ $doctor->first_name }} {{ $doctor->last_name }}"
            };
        @endforeach

        const categoriesData = @json($categories->pluck('name', 'id'));
        const servicesData = @json($services->pluck('name', 'id'));

        function goToStep(step) {
            // Validate current step before proceeding
            if (!validateStep(currentStep)) return;

            // Update progress steps
            document.querySelectorAll('.step').forEach(s => {
                s.classList.remove('active', 'completed');
                if (s.dataset.step < step) {
                    s.classList.add('completed');
                } else if (s.dataset.step == step) {
                    s.classList.add('active');
                }
            });

            // Show the correct form step
            document.querySelectorAll('.form-step').forEach(stepDiv => {
                stepDiv.classList.remove('active');
            });
            document.getElementById(`step-${step}`).classList.add('active');

            // Populate data if needed
            if (step === 2) {
                populateTimeSlots();
            } else if (step === 4) {
                populateConfirmationDetails();
            } else if (step === 5) {
                populateFinalDetails();
                // Ensure the hidden input has the selected time slot before submission
                if (!selectedTimeSlot) {
                    alert('No time slot selected. Please go back and select a time slot.');
                    goToStep(2);
                    return;
                }
                document.getElementById('appointmentTime').value = selectedTimeSlot;
                console.log('Final appointment_time before submission:', document.getElementById('appointmentTime').value);

                const form = document.getElementById('bookingForm');
                const formData = new FormData(form);
                console.log('Form data being submitted:');
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                // Submit the form via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Appointment booked successfully:', data.message);
                        // Already on Step 5, no further action needed
                    } else {
                        alert('Failed to book appointment: ' + (data.message || 'Unknown error'));
                        goToStep(1); // Go back to Step 1 if there's an error
                    }
                })
                .catch(error => {
                    console.error('Error submitting form:', error);
                    alert('An error occurred while booking the appointment. Please try again.');
                    goToStep(1); // Go back to Step 1 on error
                });
            }

            currentStep = step;
        }

        function validateStep(step) {
            if (step === 1) {
                const doctor = document.getElementById('doctor').value;
                const appointmentType = document.getElementById('appointment_type').value;
                const date = document.getElementById('date').value;
                if (!doctor || !appointmentType || !date) {
                    alert('Please fill all required fields.');
                    return false;
                }
            } else if (step === 2) {
                const timeSlot = document.querySelector('input[name="temp_appointment_time"]:checked');
                if (!timeSlot) {
                    alert('Please select a time slot.');
                    return false;
                }
                // Store the selected time slot globally
                selectedTimeSlot = timeSlot.value;
                document.getElementById('appointmentTime').value = selectedTimeSlot;
                console.log('Selected time slot in validateStep:', selectedTimeSlot);
            } else if (step === 3) {
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
                if (!paymentMethod) {
                    alert('Please select a payment method.');
                    return false;
                }
            }
            return true;
        }

        function populateTimeSlots() {
            const doctorId = document.getElementById('doctor').value;
            const timeSlotsContainer = document.getElementById('timeSlots');
            timeSlotsContainer.innerHTML = '';

            if (doctorId && doctorsData[doctorId]) {
                let timings = doctorsData[doctorId].timings;
                
                // Ensure timings is an array of individual time slots
                if (typeof timings === 'string') {
                    timings = timings.split(',').map(slot => slot.trim());
                } else if (!Array.isArray(timings)) {
                    timings = [];
                } else if (timings.length === 1 && timings[0].includes(',')) {
                    // If timings is an array with a single comma-separated string, split it
                    timings = timings[0].split(',').map(slot => slot.trim());
                }

                console.log('Processed doctor timings:', timings);

                if (timings.length === 0) {
                    timeSlotsContainer.innerHTML = '<p>No available time slots for this doctor.</p>';
                    return;
                }

                timings.forEach((slot, index) => {
                    const slotDiv = document.createElement('div');
                    slotDiv.className = 'time-slot';
                    slotDiv.innerHTML = `
                        <input type="radio" id="time${index + 1}" name="temp_appointment_time" value="${slot}" required>
                        <label for="time${index + 1}">${slot}</label>
                    `;
                    timeSlotsContainer.appendChild(slotDiv);

                    // Add divider after the 5th slot if needed
                    if (index === 4) {
                        const divider = document.createElement('div');
                        divider.className = 'divider';
                        timeSlotsContainer.appendChild(divider);
                    }
                });

                // Store category, service, and specialties for submission
                document.getElementById('categoryIds').value = doctorsData[doctorId].category_ids;
                document.getElementById('serviceIds').value = doctorsData[doctorId].service_ids;
                document.getElementById('specialties').value = doctorsData[doctorId].specialties;

                // Reset the selected time slot and hidden input
                selectedTimeSlot = '';
                document.getElementById('appointmentTime').value = '';
                console.log('Reset appointmentTime after populating time slots:', document.getElementById('appointmentTime').value);
            }
        }

        function populateConfirmationDetails() {
            const doctorId = document.getElementById('doctor').value;
            const appointmentType = document.getElementById('appointment_type').value;
            const date = document.getElementById('date').value;
            const time = selectedTimeSlot; // Use the globally stored time slot

            const doctorData = doctorsData[doctorId];
            const categoryIds = doctorData.category_ids.split(',');
            const serviceIds = doctorData.service_ids.split(',');
            const specialties = doctorData.specialties.split(',');

            const categoryNames = categoryIds.map(id => categoriesData[id] || 'Unknown').join(', ');
            const serviceNames = serviceIds.map(id => servicesData[id] || 'Unknown').join(', ');

            document.getElementById('confirmationDetails').innerHTML = `
                <div class="detail-row">
                    <span class="detail-label">Doctor</span>
                    <span class="detail-value">${doctorData.name}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Category</span>
                    <span class="detail-value">${categoryNames}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Service</span>
                    <span class="detail-value">${serviceNames}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Specialties</span>
                    <span class="detail-value">${specialties.join(', ')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Type</span>
                    <span class="detail-value">${appointmentType.charAt(0).toUpperCase() + appointmentType.slice(1)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Date</span>
                    <span class="detail-value">${date}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Time</span>
                    <span class="detail-value">${time}</span>
                </div>
            `;
        }

        function populateFinalDetails() {
            const doctorId = document.getElementById('doctor').value;
            const appointmentType = document.getElementById('appointment_type').value;
            const date = document.getElementById('date').value;
            const time = selectedTimeSlot; // Use the globally stored time slot

            const doctorData = doctorsData[doctorId];
            const categoryIds = doctorData.category_ids.split(',');
            const serviceIds = doctorData.service_ids.split(',');
            const specialties = doctorData.specialties.split(',');

            const categoryNames = categoryIds.map(id => categoriesData[id] || 'Unknown').join(', ');
            const serviceNames = serviceIds.map(id => servicesData[id] || 'Unknown').join(', ');

            document.getElementById('finalDetails').innerHTML = `
                <div class="detail-row">
                    <span class="detail-label">Doctor</span>
                    <span class="detail-value">${doctorData.name}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Category</span>
                    <span class="detail-value">${categoryNames}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Service</span>
                    <span class="detail-value">${serviceNames}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Specialties</span>
                    <span class="detail-value">${specialties.join(', ')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Type</span>
                    <span class="detail-value">${appointmentType.charAt(0).toUpperCase() + appointmentType.slice(1)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Date</span>
                    <span class="detail-value">${date}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Appointment Time</span>
                    <span class="detail-value">${time}</span>
                </div>
            `;
        }

        // Populate time slots when doctor changes
        document.getElementById('doctor').addEventListener('change', function() {
            if (currentStep === 2) {
                populateTimeSlots();
            }
        });

        // Ensure the selected time slot is updated when a radio button is clicked
        document.addEventListener('change', function(event) {
            if (event.target.name === 'temp_appointment_time') {
                selectedTimeSlot = event.target.value;
                document.getElementById('appointmentTime').value = selectedTimeSlot;
                console.log('Time slot updated on change:', selectedTimeSlot);
            }
        });
    </script>
</body>
</html>