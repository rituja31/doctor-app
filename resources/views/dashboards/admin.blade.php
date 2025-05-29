<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Doctor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
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
        }

        .admin-avatar i {
            color: var(--primary-color);
        }

        .admin-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .admin-email {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .admin-role {
            display: inline-block;
            background-color: var(--primary-light);
            color: var(--primary-color);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
            background-color: var(--primary-light);
        }

        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1rem;
            text-align: center;
        }

        .logout-btn {
            width: calc(100% - 40px);
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Profile Logout Button */
        .profile-logout-btn {
            width: calc(100% - 40px);
            margin: 10px 20px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px;
            border-radius: 5px;
            background-color: var(--primary-light);
            color: var(--primary-color);
            border: none;
            transition: var(--transition);
        }

        .profile-logout-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            padding: 30px;
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
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .add-doctor-btn {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
        }

        .stat-item {
            text-align: center;
            padding: 0 15px;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
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
        }

        .search-box {
            position: relative;
            width: 250px;
        }

        .search-box input {
            padding-left: 35px;
            border-radius: 20px;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 10px;
            color: var(--secondary-color);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--secondary-color);
            font-weight: 600;
            border-bottom-width: 1px;
            padding: 15px 20px;
        }

        .table tbody td {
            padding: 15px 20px;
            vertical-align: middle;
        }

        .action-btn {
            padding: 5px 12px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--primary-color);
        }

        .btn-view {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .btn-delete {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .specialty-badge {
            display: inline-block;
            background-color: #f1f5f9;
            color: var(--dark-color);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 5px;
            margin-bottom: 5px;
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
            }
            .stats-card {
                flex-direction: column;
                gap: 20px;
            }
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            .search-box {
                width: 100%;
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
                <a href="#" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-md"></i>
                    Doctors
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-procedures"></i>
                    Patients
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-calendar-check"></i>
                    Appointments
                </a>
            </div>
        </div>

        <!-- Removed the duplicate logout button from the bottom -->
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
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="40" height="40" alt="Doctor">
                                    <div>
                                        <h6 class="mb-0">Dr. Nehal Dessai</h6>
                                        <small class="text-muted">Cardiologist</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>nd@gmail.com</div>
                                <small class="text-muted">+1 (555) 123-4567</small>
                            </td>
                            <td>
                                <span class="specialty-badge">Cardiology</span>
                                <span class="specialty-badge">Internal Medicine</span>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('edit.page') }}'" class="btn btn-sm btn-edit action-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-view action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-delete action-btn">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="40" height="40" alt="Doctor">
                                    <div>
                                        <h6 class="mb-0">Dr. Sarah Johnson</h6>
                                        <small class="text-muted">Neurologist</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>sjohnson@example.com</div>
                                <small class="text-muted">+1 (555) 987-6543</small>
                            </td>
                            <td>
                                <span class="specialty-badge">Neurology</span>
                                <span class="specialty-badge">Pediatrics</span>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success">Active</span>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('edit.page') }}'" class="btn btn-sm btn-edit action-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-view action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-delete action-btn">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://randomuser.me/api/portraits/men/75.jpg" class="rounded-circle me-3" width="40" height="40" alt="Doctor">
                                    <div>
                                        <h6 class="mb-0">Dr. Michael Chen</h6>
                                        <small class="text-muted">Orthopedic Surgeon</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>mchen@example.com</div>
                                <small class="text-muted">+1 (555) 456-7890</small>
                            </td>
                            <td>
                                <span class="specialty-badge">Orthopedics</span>
                                <span class="specialty-badge">Sports Medicine</span>
                            </td>
                            <td>
                                <span class="badge bg-warning bg-opacity-10 text-warning">On Leave</span>
                            </td>
                            <td>
                                <button onclick="window.location.href='{{ route('edit.page') }}'" class="btn btn-sm btn-edit action-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-view action-btn">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn btn-sm btn-delete action-btn">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
            <input type="text" class="form-control" id="firstName" name="first_name" required>
        </div>
        <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="specialties" class="form-label">Specialties</label>
        <input type="text" class="form-control" id="specialties" name="specialties" placeholder="e.g. Cardiology, Internal Medicine" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status">
            <option value="Active" selected>Active</option>
            <option value="On Leave">On Leave</option>
            <option value="Retired">Retired</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Doctor</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
</form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // You can add your custom JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>