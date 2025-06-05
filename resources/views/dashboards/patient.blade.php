<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | MediCare</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2a7fba;
            --primary-dark: #1e6a9b;
            --secondary-color: #4b5e6d;
            --accent-color: #e0f2fe;
            --dark-color: #1f2a44;
            --light-color: #f5f7fa;
            --text-color: #2d3748;
            --text-light: #64748b;
            --white: #ffffff;
            --success: #28a745;
            --warning: #f59e0b;
            --danger: #dc3545;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 6px 12px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 12px 20px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e1e7ef 100%);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
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

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
        }

        .sidebar-header .logo {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .profile {
            text-align: center;
            padding: 25px 20px;
            background-color: var(--white);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .profile .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 32px;
            color: var(--primary-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .profile .avatar:hover {
            transform: scale(1.05);
        }

        .profile h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .profile p {
            font-size: 0.95rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .profile .role-badge {
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--white);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-top: 10px;
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
            background-color: var(--accent-color);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .nav-links a.active {
            background-color: var(--accent-color);
            color: var(--primary-color);
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            padding: 12px 25px;
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
            transform: translateY(-2px);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: var(--transition);
        }

        .navbar {
            background-color: var(--white);
            padding: 1.2rem 2rem;
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
            gap: 20px;
        }

        .navbar a {
            color: var(--white);
            text-decoration: none;
            background-color: var(--primary-color);
            padding: 10px 20px;
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
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .notification-bell {
            position: relative;
            color: var(--text-color);
            font-size: 1.3rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .notification-bell:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger);
            color: var(--white);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .dashboard {
            padding: 30px;
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--white), #f8fafc);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .welcome-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, var(--primary-color), var(--primary-dark));
        }

        .welcome-card h2 {
            color: var(--dark-color);
            margin-bottom: 15px;
            font-size: 1.9rem;
            font-weight: 700;
        }

        .welcome-card h2 span {
            color: var(--primary-color);
        }

        .welcome-card p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 20px;
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
            border-radius: 12px;
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
            font-size: 1.3rem;
            color: var(--white);
            transition: var(--transition);
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

        .info-icon:hover {
            transform: scale(1.1);
        }

        .info-content h4 {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .info-content p {
            font-size: 1.05rem;
            color: var(--text-color);
            font-weight: 600;
            margin: 0;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .action-card {
            background: linear-gradient(135deg, var(--white), #f8fafc);
            padding: 25px;
            border-radius: 12px;
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
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            transition: var(--transition);
        }

        .action-card:hover i {
            transform: scale(1.1);
        }

        .action-card h3 {
            font-size: 1.15rem;
            margin-bottom: 10px;
            color: var(--dark-color);
            font-weight: 600;
        }

        .action-card p {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        /* Sidebar Toggle Button */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 110;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
        }

        .sidebar-toggle:hover {
            background-color: var(--primary-dark);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .sidebar-toggle {
                display: block;
            }
        }

        @media (max-width: 768px) {
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
            .welcome-card h2 {
                font-size: 1.6rem;
            }
            .welcome-card p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <div class="logo">MediCare</div>
        </div>

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
                </div>
            </div>

            <div class="quick-actions">
                <div class="action-card" onclick="window.location.href='{{ route('appointment.page') }}'">
                    <i class="fas fa-calendar-plus"></i>
                    <h3>Book Appointment</h3>
                    <p>Schedule a new consultation with your doctor</p>
                </div>
                
                <div class="action-card" onclick="window.location.href='{{ route('patient.settings') }}'">
                    <i class="fas fa-user-cog"></i>
                    <h3>Profile Settings</h3>
                    <p>Update your personal information</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>