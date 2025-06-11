<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Profile</title>
    <style>
        :root {
            --primary-color: #4a6cf7;
            --border-color: #e2e8f0;
            --text-color: #2d3748;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-color);
            line-height: 1.6;
            padding: 40px;
        }

        .edit-form-container {
            background: white;
            max-width: 900px;
            margin: auto;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-header h2 {
            color: var(--text-color);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: #ebf8f2;
            color: #38a169;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
        }

        .btn-secondary {
            background-color: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #f5f7fa;
        }

        .invalid-feedback {
            color: #e3342f;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .is-invalid {
            border-color: #e3342f;
        }

        .is-invalid ~ .invalid-feedback,
        .is-invalid .invalid-feedback {
            display: block;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .form-check {
            margin-bottom: 5px;
        }

        .form-check-input {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="edit-form-container">
        <div class="form-header">
            <h2>Edit Doctor Profile</h2>
            <span class="status-badge">{{ old('status', $doctor->status) }}</span>
        </div>
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <strong>Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" id="editDoctorForm">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="first_name" value="{{ old('first_name', $doctor->first_name) }}" required
                           class="@error('first_name') is-invalid @enderror">
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="last_name" value="{{ old('last_name', $doctor->last_name) }}" required
                           class="@error('last_name') is-invalid @enderror">
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $doctor->email) }}" required
                           class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password (Leave blank to keep current)</label>
                    <input type="password" id="password" name="password" placeholder="Enter New Password (min 4 chars)"
                           class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" required
                           class="@error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Working Days</label>
                    @php
                        $workingDays = $doctor->working_days ? explode(',', $doctor->working_days) : [];
                        $allDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'All Days'];
                    @endphp
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="working_days_all" name="working_days[]" value="All Days"
                               {{ in_array('All Days', old('working_days', $workingDays)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="working_days_all">All Days</label>
                    </div>
                    @foreach ($allDays as $day)
                        @if ($day !== 'All Days')
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="working_days_{{ strtolower($day) }}" name="working_days[]" value="{{ $day }}"
                                       {{ in_array($day, old('working_days', $workingDays)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="working_days_{{ strtolower($day) }}">{{ $day }}</label>
                            </div>
                        @endif
                    @endforeach
                    @error('working_days')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Categories</label>
                    @php
                        $currentCategories = $doctor->category_id ? explode(',', $doctor->category_id) : [];
                    @endphp
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="category_{{ $category->id }}" name="category_id[]" value="{{ $category->id }}"
                                   {{ in_array($category->id, old('category_id', $currentCategories)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Services</label>
                    @php
                        $currentServices = $doctor->service_id ? explode(',', $doctor->service_id) : [];
                    @endphp
                    @foreach ($services as $service)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="service_{{ $service->id }}" name="service_id[]" value="{{ $service->id }}"
                                   {{ in_array($service->id, old('service_id', $currentServices)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="service_{{ $service->id }}">{{ $service->name }} ({{ $service->category->name }})</label>
                        </div>
                    @endforeach
                    @error('service_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Appointment Timings</label>
                    @php
                        $timings = [
                            '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
                            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30',
                            '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
                            '20:00', '20:30', '21:00', '21:30', '22:00', '22:30', '23:00'
                        ];
                        $currentTimings = $doctor->timings ? explode(',', $doctor->timings) : [];
                    @endphp
                    @foreach ($timings as $time)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="timing_{{ $time }}" name="timings[]" value="{{ $time }}"
                                   {{ in_array($time, old('timings', $currentTimings)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="timing_{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</label>
                        </div>
                    @endforeach
                    @error('timings')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Working Hours - Start Time</label>
                    @php
                        $startTimes = $doctor->start_time ? explode(',', $doctor->start_time) : [];
                    @endphp
                    @foreach ($timings as $time)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="start_time_{{ $time }}" name="start_time[]" value="{{ $time }}"
                                   {{ in_array($time, old('start_time', $startTimes)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="start_time_{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</label>
                        </div>
                    @endforeach
                    @error('start_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Working Hours - End Time</label>
                    @php
                        $endTimes = $doctor->end_time ? explode(',', $doctor->end_time) : [];
                    @endphp
                    @foreach ($timings as $time)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="end_time_{{ $time }}" name="end_time[]" value="{{ $time }}"
                                   {{ in_array($time, old('end_time', $endTimes)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="end_time_{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</label>
                        </div>
                    @endforeach
                    @error('end_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Break Start Time (Optional)</label>
                    @php
                        $breakStartTimes = $doctor->break_start_time ? explode(',', $doctor->break_start_time) : [];
                    @endphp
                    @foreach ($timings as $time)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="break_start_time_{{ $time }}" name="break_start_time[]" value="{{ $time }}"
                                   {{ in_array($time, old('break_start_time', $breakStartTimes)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="break_start_time_{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</label>
                        </div>
                    @endforeach
                    @error('break_start_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Break End Time (Optional)</label>
                    @php
                        $breakEndTimes = $doctor->break_end_time ? explode(',', $doctor->break_end_time) : [];
                    @endphp
                    @foreach ($timings as $time)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="break_end_time_{{ $time }}" name="break_end_time[]" value="{{ $time }}"
                                   {{ in_array($time, old('break_end_time', $breakEndTimes)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="break_end_time_{{ $time }}">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</label>
                        </div>
                    @endforeach
                    @error('break_end_time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="@error('status') is-invalid @enderror">
                        <option value="Active" {{ old('status', $doctor->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="On Leave" {{ old('status', $doctor->status) == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                        <option value="Retired" {{ old('status', $doctor->status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Doctor</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('working_days_all').addEventListener('change', function () {
                const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                days.forEach(day => {
                    document.getElementById(`working_days_${day}`).checked = this.checked;
                });
            });

            document.getElementById('editDoctorForm').addEventListener('submit', function (e) {
                // Client-side validation for time fields
                const startTimes = document.querySelectorAll('input[name="start_time[]"]:checked');
                const endTimes = document.querySelectorAll('input[name="end_time[]"]:checked');
                const breakStartTimes = document.querySelectorAll('input[name="break_start_time[]"]:checked');
                const breakEndTimes = document.querySelectorAll('input[name="break_end_time[]"]:checked');

                if (startTimes.length !== endTimes.length) {
                    e.preventDefault();
                    alert('The number of start times must match the number of end times.');
                    return;
                }

                if (breakStartTimes.length !== breakEndTimes.length) {
                    e.preventDefault();
                    alert('The number of break start times must match the number of break end times.');
                    return;
                }

                for (let i = 0; i < startTimes.length; i++) {
                    const startTime = startTimes[i].value;
                    const endTime = endTimes[i].value;
                    if (startTime >= endTime) {
                        e.preventDefault();
                        alert('End time must be after start time for all time slots.');
                        return;
                    }
                }

                for (let i = 0; i < breakStartTimes.length; i++) {
                    const breakStartTime = breakStartTimes[i].value;
                    const breakEndTime = breakEndTimes[i].value;
                    if (breakStartTime >= breakEndTime) {
                        e.preventDefault();
                        alert('Break end time must be after break start time.');
                        return;
                    }
                    let withinWorkingHours = false;
                    for (let j = 0; j < startTimes.length; j++) {
                        if (breakStartTime >= startTimes[j].value && breakEndTime <= endTimes[j].value) {
                            withinWorkingHours = true;
                            break;
                        }
                    }
                    if (!withinWorkingHours && breakStartTimes.length > 0) {
                        e.preventDefault();
                        alert('Break times must be within working hours.');
                        return;
                    }
                }

                console.log('Form submission with data:', new FormData(this));
            });
        });
    </script>
</body>
</html>