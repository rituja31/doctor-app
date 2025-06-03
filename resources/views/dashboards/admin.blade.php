<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Doctor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles remain unchanged */
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

        /* Sidebar Styles */
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

        /* Profile Logout Button */
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

        /* Main Content Styles */
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

        /* Stats Cards */
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

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .table-title {
            font-weight: 600;
            margin: 0;
            font-size: 1.25rem;
            color: var(--dark-color);
        }

        .search-box {
            position: relative;
            width: 250px;
        }

        .search-box input {
            padding-left: 35px;
            border-radius: 20px;
            font-size: 0.85rem;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 10px;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .table {
            margin: 0;
            font-size: 0.9rem;
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--secondary-color);
            font-weight: 600;
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

        /* Pagination */
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

        /* Modal Styles */
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

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Responsive Styles */
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
            
            <!-- Logout Button Below Profile -->
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
            <div class="table-header">
                <h3 class="table-title">All Doctors</h3>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search doctors...">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Contact</th>
                            <th>Specialties</th>
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
                                    @foreach (explode(',', $doctor->specialties) as $specialty)
                                        <span class="specialty-badge">{{ trim($specialty) }}</span>
                                    @endforeach
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
                                <td colspan="5" class="text-center">No doctors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                        <form action="{{ route('doctors.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="service_id" class="form-label">Service</label>
                                <select class="form-select @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
                                    <option value="" selected disabled>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>{{ $service->name }} ({{ $service->category->name }})</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>