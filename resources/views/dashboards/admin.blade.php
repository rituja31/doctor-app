<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Doctor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #e0f2ff;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .admin-sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background-color: white;
            box-shadow: var(--shadow-md);
            z-index: 100;
            padding: 20px 0;
            transition: var(--transition);
        }

        .admin-profile {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-light);
            margin-bottom: 15px;
            background-color: #e0f2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 2rem;
            margin: 0 auto 15px;
            transition: var(--transition);
        }

        .admin-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.2);
        }

        .admin-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark-color);
        }

        .admin-email {
            color: var(--secondary-color);
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .admin-role {
            display: inline-block;
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
        }

        .nav-menu {
            padding: 15px 0;
        }

        .nav-item {
            margin-bottom: 3px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.9rem;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(37, 99, 235, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1rem;
            text-align: center;
        }

        .profile-logout-btn {
            width: calc(100% - 40px);
            margin: 10px 20px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 6px;
            background-color: var(--primary-light);
            color: var(--primary-color);
            border: none;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.85rem;
        }

        .profile-logout-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.15);
        }

        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: var(--transition);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title {
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
            font-size: 1.75rem;
        }

        .add-doctor-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-weight: 500;
            transition: var(--transition);
        }

        .add-doctor-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.15);
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .stat-item {
            text-align: center;
            padding: 0 15px;
            position: relative;
        }

        .stat-item:not(:last-child):after {
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 50px;
            width: 1px;
            background-color: var(--border-color);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
            line-height: 1.2;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .table-header {
            font-weight: 600;
            color: var(--secondary-color);
            border-bottom-width: 1px;
            padding: 15px 20px;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
            border-top: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.02);
        }

        .action-btn {
            padding: 5px 12px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 4px;
            transition: var(--transition);
            font-weight: 500;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .btn-edit:hover {
            background-color: rgba(59, 130, 246, 0.2);
        }

        .btn-view {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .btn-view:hover {
            background-color: rgba(16, 185, 129, 0.2);
        }

        .btn-delete {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .btn-delete:hover {
            background-color: rgba(239, 68, 68, 0.2);
        }

        .specialty-badge {
            display: inline-block;
            background-color: #f1f5f9;
            color: var(--dark-color);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-right: 5px;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .badge {
            font-weight: 500;
            padding: 5px 10px;
            font-size: 0.75rem;
        }

        .pagination .page-item .page-link {
            font-size: 0.85rem;
            color: var(--secondary-color);
            border: 1px solid var(--border-color);
            margin: 0 3px;
            border-radius: 6px !important;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 20px 25px;
        }

        .modal-title {
            font-weight: 600;
            color: var(--dark-color);
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
            padding: 15px 25px;
        }

        .form-control, .form-select, .bootstrap-select .dropdown-toggle {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus, .bootstrap-select .dropdown-toggle:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .bootstrap-select .dropdown-menu {
            max-height: 300px !important;
            overflow-y: auto;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
            }
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .stats-card {
                flex-direction: column;
                gap: 25px;
            }
            .stat-item:not(:last-child):after {
                display: none;
            }
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px;
            }
            .search-box {
                width: 100%;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="admin-sidebar">
        <div class="admin-profile">
            <div class="admin-avatar">
                <i class="fas fa-user-shield"></i>
            </div>
            <h5 class="admin-name">Admin</h5>
            <p class="admin-email">{{ session('admin_email', 'admin@medicare.com') }}</p>
            <span class="admin-role">Administrator</span>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="profile-logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </form>
        </div>

        <div class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ Route::is('categories.index') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i>
                    Categories
                </a>
            </div>
            
            <div class="nav-item">
                <a href="{{ route('services') }}" class="nav-link {{ Route::is('services') ? 'active' : '' }}">
                    <i class="fas fa-concierge-bell"></i>
                    Services
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Doctor Management</h1>
            <button class="btn btn-primary add-doctor-btn" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
                <i class="fas fa-plus"></i> Add New Doctor
            </button>
        </div>

        <!-- Doctors Table -->
        <div class="table-container">
            <div class="table-header d-flex justify-content-between align-items-center">
                <h3 class="table-title mb-0">All Doctors</h3>
                <div class="search-box position-relative">
                    <i class="fas fa-search position-absolute" style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
                    <input type="text" class="form-control ps-5" id="searchInput" placeholder="Search doctors...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover" id="doctorsTable">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Contact</th>
                            <th>Specialties</th>
                            <th>Working Days</th>
                            <th>Appointment Timings</th>
                            <th>Working Hours</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $doctor->image ?? 'https://randomuser.me/api/portraits/men/' . rand(1, 99) . '.jpg' }}" class="rounded-circle me-3" width="40" height="40" alt="Doctor">
                                        <div>
                                            <h6 class="mb-0">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h6>
                                            <small class="text-muted">{{ $doctor->specialties }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $doctor->email }}</div>
                                    <small class="text-muted">{{ $doctor->phone }}</small>
                                </td>
                                <td>
                                    @if ($doctor->specialties)
                                        @php
                                            $uniqueSpecialties = array_unique(array_filter(array_map('trim', explode(',', $doctor->specialties))));
                                        @endphp
                                        @foreach ($uniqueSpecialties as $specialty)
                                            <span class="specialty-badge">{{ $specialty }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No specialties</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($doctor->working_days)
                                        @php
                                            $workingDays = is_array($doctor->working_days) ? $doctor->working_days : explode(',', $doctor->working_days);
                                        @endphp
                                        @foreach ($workingDays as $day)
                                            @if (trim($day))
                                                <span class="specialty-badge">{{ $day }}</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">No working days</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($doctor->timings)
                                        @php
                                            $timings = is_array($doctor->timings) ? $doctor->timings : explode(',', $doctor->timings);
                                        @endphp
                                        @foreach ($timings as $time)
                                            @if (trim($time))
                                                <span class="specialty-badge">{{ \Carbon\Carbon::createFromFormat('H:i', $time)->format('h:i A') }}</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">No timings</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($doctor->start_time && $doctor->end_time)
                                        @php
                                            $startTimes = is_array($doctor->start_time) ? $doctor->start_time : explode(',', $doctor->start_time);
                                            $endTimes = is_array($doctor->end_time) ? $doctor->end_time : explode(',', $doctor->end_time);
                                            $breakStartTimes = $doctor->break_start_time ? (is_array($doctor->break_start_time) ? $doctor->break_start_time : explode(',', $doctor->break_start_time)) : [];
                                            $breakEndTimes = $doctor->break_end_time ? (is_array($doctor->break_end_time) ? $doctor->break_end_time : explode(',', $doctor->break_end_time)) : [];
                                        @endphp
                                        @foreach ($startTimes as $index => $startTime)
                                            @if (trim($startTime) && isset($endTimes[$index]) && trim($endTimes[$index]))
                                                <div>
                                                    <span class="specialty-badge">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i', $startTime)->format('h:i A') }} - 
                                                        {{ \Carbon\Carbon::createFromFormat('H:i', $endTimes[$index])->format('h:i A') }}
                                                        @if (!empty($breakStartTimes[$index]) && !empty($breakEndTimes[$index]))
                                                            (Break: {{ \Carbon\Carbon::createFromFormat('H:i', $breakStartTimes[$index])->format('h:i A') }} - 
                                                            {{ \Carbon\Carbon::createFromFormat('H:i', $breakEndTimes[$index])->format('h:i A') }})
                                                        @endif
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">No working hours</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $doctor->status == 'Active' ? 'success' : ($doctor->status == 'On Leave' ? 'warning' : 'danger') }} bg-opacity-10 text-{{ $doctor->status == 'Active' ? 'success' : ($doctor->status == 'On Leave' ? 'warning' : 'danger') }}">{{ $doctor->status }}</span>
                                </td>
                                <td>
                                    <button onclick="window.location.href='{{ route('edit.page', $doctor->id) }}'" class="btn btn-sm btn-edit action-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button onclick="window.location.href='{{ route('doctors.show', $doctor->id) }}'" class="btn btn-sm btn-view action-btn">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete action-btn" onclick="return confirm('Are you sure you want to delete this doctor?')">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No doctors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $doctors->links() }}
            </div>
        </div>

        <!-- Add Doctor Modal -->
        <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDoctorModalLabel">Add New Doctor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Errors:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('doctors.store') }}" method="POST" id="addDoctorForm">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Doctor's Email" required autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password (min 4 chars)" required autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Working Days</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_all" name="working_days[]" value="All Days" {{ in_array('All Days', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_all">All Days</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_sunday" name="working_days[]" value="Sunday" {{ in_array('Sunday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_sunday">Sunday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_monday" name="working_days[]" value="Monday" {{ in_array('Monday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_monday">Monday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_tuesday" name="working_days[]" value="Tuesday" {{ in_array('Tuesday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_tuesday">Tuesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_wednesday" name="working_days[]" value="Wednesday" {{ in_array('Wednesday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_wednesday">Wednesday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_thursday" name="working_days[]" value="Thursday" {{ in_array('Thursday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_thursday">Thursday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_friday" name="working_days[]" value="Friday" {{ in_array('Friday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_friday">Friday</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="working_days_saturday" name="working_days[]" value="Saturday" {{ in_array('Saturday', old('working_days', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="working_days_saturday">Saturday</label>
                                    </div>
                                    @error('working_days')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Categories</label>
                                <select class="form-select selectpicker @error('category_id') is-invalid @enderror" id="category_id" name="category_id[]" multiple data-live-search="true" data-placeholder="Select Categories" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ in_array($category->id, old('category_id', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Services</label>
                                <select class="form-select selectpicker @error('service_id') is-invalid @enderror" id="service_id" name="service_id[]" multiple data-live-search="true" data-placeholder="Select Services" required>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" {{ in_array($service->id, old('service_id', [])) ? 'selected' : '' }}>{{ $service->name }} ({{ $service->category->name }})</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="timings" class="form-label">Appointment Timings</label>
                                @php
                                    $timings = [
                                        '08:00 AM' => '08:00', '08:30 AM' => '08:30', '09:00 AM' => '09:00', '09:30 AM' => '09:30',
                                        '10:00 AM' => '10:00', '10:30 AM' => '10:30', '11:00 AM' => '11:00', '11:30 AM' => '11:30',
                                        '12:00 PM' => '12:00', '12:30 PM' => '12:30', '01:00 PM' => '13:00', '01:30 PM' => '13:30',
                                        '02:00 PM' => '14:00', '02:30 PM' => '14:30', '03:00 PM' => '15:00', '03:30 PM' => '15:30',
                                        '04:00 PM' => '16:00', '04:30 PM' => '16:30', '05:00 PM' => '17:00', '05:30 PM' => '17:30',
                                        '06:00 PM' => '18:00', '06:30 PM' => '18:30', '07:00 PM' => '19:00', '07:30 PM' => '19:30',
                                        '08:00 PM' => '20:00', '08:30 PM' => '20:30', '09:00 PM' => '21:00', '09:30 PM' => '21:30',
                                        '10:00 PM' => '22:00', '10:30 PM' => '22:30', '11:00 PM' => '23:00'
                                    ];
                                @endphp
                                <select class="form-select selectpicker @error('timings') is-invalid @enderror" id="timings" name="timings[]" multiple data-live-search="true" data-placeholder="Select Appointment Timings" required>
                                    @foreach ($timings as $display => $value)
                                        <option value="{{ $value }}" {{ in_array($value, old('timings', [])) ? 'selected' : '' }}>{{ $display }}</option>
                                    @endforeach
                                </select>
                                @error('timings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Working Hours</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <select class="form-select selectpicker @error('start_time') is-invalid @enderror" id="start_time" name="start_time[]" multiple data-live-search="true" data-placeholder="Select Start Times" required>
                                            @foreach ($timings as $display => $value)
                                                <option value="{{ $value }}" {{ in_array($value, old('start_time', [])) ? 'selected' : '' }}>{{ $display }}</option>
                                            @endforeach
                                        </select>
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <select class="form-select selectpicker @error('end_time') is-invalid @enderror" id="end_time" name="end_time[]" multiple data-live-search="true" data-placeholder="Select End Times" required>
                                            @foreach ($timings as $display => $value)
                                                <option value="{{ $value }}" {{ in_array($value, old('end_time', [])) ? 'selected' : '' }}>{{ $display }}</option>
                                            @endforeach
                                        </select>
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="break_start_time" class="form-label">Break Start Time</label>
                                        <select class="form-select selectpicker @error('break_start_time') is-invalid @enderror" id="break_start_time" name="break_start_time[]" multiple data-live-search="true" data-placeholder="Select Break Start Times">
                                            @foreach ($timings as $display => $value)
                                                <option value="{{ $value }}" {{ in_array($value, old('break_start_time', [])) ? 'selected' : '' }}>{{ $display }}</option>
                                            @endforeach
                                        </select>
                                        @error('break_start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="break_end_time" class="form-label">Break End Time</label>
                                        <select class="form-select selectpicker @error('break_end_time') is-invalid @enderror" id="break_end_time" name="break_end_time[]" multiple data-live-search="true" data-placeholder="Select Break End Times">
                                            @foreach ($timings as $display => $value)
                                                <option value="{{ $value }}" {{ in_array($value, old('break_end_time', [])) ? 'selected' : '' }}>{{ $display }}</option>
                                            @endforeach
                                        </select>
                                        @error('break_end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="On Leave" {{ old('status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                    <option value="Retired" {{ old('status') == 'Retired' ? 'selected' : '' }}>Retired</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add Doctor</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap Select
            $('.selectpicker').selectpicker({
                liveSearch: true,
                liveSearchPlaceholder: 'Search...',
                width: '100%',
                maxOptions: 10 // Optional: Limit for timing-related dropdowns
            });

            // Handle "All Days" checkbox
            const allDaysCheckbox = document.getElementById('working_days_all');
            const dayCheckboxes = [
                'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'
            ].map(day => document.getElementById(`working_days_${day}`));

            allDaysCheckbox.addEventListener('change', function () {
                dayCheckboxes.forEach(checkbox => {
                    if (checkbox) checkbox.checked = this.checked;
                });
            });

            // Client-side validation
            document.getElementById('addDoctorForm').addEventListener('submit', function (e) {
                const timings = document.querySelectorAll('#timings option:checked');
                const categories = document.querySelectorAll('#category_id option:checked');
                const services = document.querySelectorAll('#service_id option:checked');
                const startTimes = document.querySelectorAll('#start_time option:checked');
                const endTimes = document.querySelectorAll('#end_time option:checked');
                const breakStartTimes = document.querySelectorAll('#break_start_time option:checked');
                const breakEndTimes = document.querySelectorAll('#break_end_time option:checked');
                const workingDays = document.querySelectorAll('input[name="working_days[]"]:checked');

                // Validate working days
                if (workingDays.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one working day.');
                    return;
                }

                // Validate timings
                if (timings.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one appointment timing.');
                    return;
                }

                // Validate categories
                if (categories.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one category.');
                    return;
                }

                // Validate services
                if (services.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one service.');
                    return;
                }

                // Validate working hours
                if (startTimes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one start time.');
                    return;
                }
                if (endTimes.length === 0) {
                    e.preventDefault();
                    alert('Please select at least one end time.');
                    return;
                }
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

                // Validate start/end times
                for (let i = 0; i < startTimes.length; i++) {
                    const startTime = startTimes[i].value;
                    const endTime = endTimes[i].value;
                    if (startTime >= endTime) {
                        e.preventDefault();
                        alert('End time must be after start time for all time slots.');
                        return;
                    }
                }

                // Validate break times
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
                    if (!withinWorkingHours) {
                        e.preventDefault();
                        alert('Break times must be within working hours.');
                        return;
                    }
                }

                // Log form data for debugging
                const formData = new FormData(this);
                console.log('Form data:', Object.fromEntries(formData));
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(trigger => new bootstrap.Tooltip(trigger));

            // Search doctors table
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('doctorsTable');
            const rows = table.getElementsByTagName('tr');

            searchInput.addEventListener('input', function () {
                const searchText = this.value.toLowerCase();
                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const doctorName = row.cells[0].textContent.toLowerCase();
                    const email = row.cells[1].textContent.toLowerCase();
                    const specialties = row.cells[2].textContent.toLowerCase();
                    const workingDays = row.cells[3].textContent.toLowerCase();
                    const timings = row.cells[4].textContent.toLowerCase();
                    const workingHours = row.cells[5].textContent.toLowerCase();
                    if (
                        doctorName.includes(searchText) ||
                        email.includes(searchText) ||
                        specialties.includes(searchText) ||
                        workingDays.includes(searchText) ||
                        timings.includes(searchText) ||
                        workingHours.includes(searchText)
                    ) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        });
    </script>
</body>
</html>