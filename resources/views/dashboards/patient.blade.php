<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | MediCare</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #3b82f6;
            --accent-color: #00c4ff;
            --dark-color: #1f3557;
            --light-color: #f8fafc;
            --text-color: #334155;
            --text-light: #64748b;
            --white: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: var(--white);
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: var(--shadow-md);
            z-index: 100;
            transition: var(--transition);
        }

        .profile {
            text-align: center;
            padding: 30px 20px;
            background-color: var(--white);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .profile .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #e0f2fe;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .profile h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .profile p {
            font-size: 0.9rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .profile .role-badge {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-top: 8px;
            font-weight: 500;
        }

        .nav-links {
            flex-grow: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            color: var(--text-color);
            padding: 12px 25px;
            text-decoration: none;
            transition: var(--transition);
            margin: 5px 15px;
            border-radius: 8px;
            font-weight: 500;
        }

        .nav-links a:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .nav-links a.active {
            background-color: #e0f2fe;
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-links a i {
            width: 24px;
            margin-right: 12px;
            font-size: 1rem;
            text-align: center;
        }

        .logout-button {
            padding: 20px;
            background-color: var(--white);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .logout-button button {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-button button:hover {
            background-color: var(--primary-dark);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: var(--transition);
        }

        .navbar {
            background-color: var(--white);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar a {
            color: var(--white);
            text-decoration: none;
            background-color: var(--primary-color);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar a:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .notification-bell {
            position: relative;
            color: var(--text-color);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger);
            color: var(--white);
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 600;
        }

        .dashboard {
            padding: 30px;
        }

        .welcome-card {
            background-color: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary-color);
        }

        .welcome-card h2 {
            color: var(--dark-color);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .welcome-card h2 span {
            color: var(--primary-color);
        }

        .welcome-card p {
            font-size: 1.05rem;
            color: var(--text-light);
            margin-bottom: 15px;
            max-width: 700px;
        }

        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .info-card {
            background-color: var(--white);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition);
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--white);
        }

        .info-icon.personal {
            background-color: var(--primary-color);
        }

        .info-icon.medical {
            background-color: var(--success);
        }

        .info-icon.contact {
            background-color: var(--warning);
        }

        .info-content h4 {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .info-content p {
            font-size: 1rem;
            color: var(--text-color);
            font-weight: 600;
            margin: 0;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .action-card {
            background-color: var(--white);
            padding: 25px;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .action-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .action-card h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--dark-color);
        }

        .action-card p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 15px;
            }
            .navbar-actions {
                width: 100%;
                justify-content: space-between;
            }
            .user-info-grid, .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .dashboard {
                padding: 20px 15px;
            }
            .welcome-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <h4>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 20) }}</h4>
            <p>{{ Auth::user()->email }}</p>
            <span class="role-badge">Patient</span>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('patient.dashboard') }}" class="active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('appointments.calendar') }}">
                <i class="fas fa-calendar-check"></i> My Appointments
            </a>
            <a href="{{ route('medical.history') }}">
                <i class="fas fa-notes-medical"></i> Medical History
            </a>
            
            <a href="{{ route('patient.settings') }}">
                <i class="fas fa-user-cog"></i> Settings
            </a>
        </div>

        <!-- Logout Button -->
        <div class="logout-button">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i> Log out
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="navbar">
            <div class="navbar-actions">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <a href="{{ route('appointment.page') }}">
                    <i class="fas fa-calendar-plus"></i> Book Appointment
                </a>
            </div>
        </div>

        <div class="dashboard">
            <div class="welcome-card">
                <h2>Welcome back, <span>{{ Auth::user()->name }}</span></h2>
                <p>Here's what's happening with your health profile today. You have 2 upcoming appointments and 1 new prescription.</p>
                
                <div class="user-info-grid">
                    <div class="info-card">
                        <div class="info-icon personal">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="info-content">
                            <h4>Full Name</h4>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon contact">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email Address</h4>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon medical">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="info-content">
                            <h4>Last Checkup</h4>
                            <p>18 March 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='{{ route('appointment.page') }}'">
                    <i class="fas fa-calendar-plus"></i>
                    <h3>Book Appointment</h3>
                    <p>Schedule a new consultation with your doctor</p>
                </div>
                
                <div class="action-card" onclick="window.location.href='{{ route('medical.history') }}'">
                    <i class="fas fa-file-medical"></i>
                    <h3>Medical Records</h3>
                    <p>View your complete medical history</p>
                </div>
                
               
                
                <div class="action-card" onclick="window.location.href='{{ route('patient.settings') }}'">
                    <i class="fas fa-user-cog"></i>
                    <h3>Profile Settings</h3>
                    <p>Update your personal information</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>