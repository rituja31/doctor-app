<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3a86ff;
            --primary-light: #ebf3ff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --border-radius: 0.375rem;
            --border-radius-lg: 0.5rem;
            --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            --box-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f7fb;
            color: var(--gray-800);
            line-height: 1.6;
        }
        
        .dashboard {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 260px;
            background: var(--white);
            padding: 1.5rem 0;
            border-right: 1px solid var(--gray-200);
            box-shadow: var(--box-shadow);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        
        .logo {
            display: flex;
            align-items: center;
            padding: 0 1.5rem 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .logo-icon {
            background-color: var(--primary);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }
        
        .logo-text h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: var(--dark);
        }
        
        .logo-text span {
            font-size: 0.75rem;
            color: var(--gray-600);
            display: block;
        }
        
        .doctor-profile {
            padding: 1.5rem;
            margin-top: 0;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
        }
        
        .doctor-avatar-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .doctor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-weight: 600;
            font-size: 1.5rem;
        }
        
        .doctor-info {
            flex: 1;
            text-align: left;
        }
        
        .doctor-name {
            font-weight: 600;
            margin: 0 0 0.25rem;
            color: var(--dark);
            font-size: 1rem;
        }
        
        .doctor-specialty {
            color: var(--gray-600);
            font-size: 0.8rem;
            margin: 0;
        }
        
        .profile-actions {
            padding: 0 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .profile-link {
            display: flex;
            align-items: center;
            color: var(--gray-700);
            text-decoration: none;
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            border-radius: var(--border-radius);
        }
        
        .profile-link:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }
        
        .profile-link.active {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }
        
        .profile-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        .logout-link {
            color: var(--danger);
            margin-top: 0.5rem;
            border-top: 1px solid var(--gray-200);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        
        .nav-menu {
            padding: 0 1rem;
            flex: 1;
            overflow-y: auto;
        }
        
        .nav-item {
            margin-bottom: 0.25rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--gray-600);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }
        
        .nav-link.active {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }
        
        .nav-link i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }
        
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 1.5rem;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .header-title {
            display: flex;
            flex-direction: column;
        }
        
        .header-title h1 {
            font-size: 1.75rem;
            margin: 0;
            color: var(--dark);
            font-weight: 600;
        }
        
        .header-title h2 {
            font-size: 0.875rem;
            color: var(--gray-600);
            margin: 0.5rem 0 0;
            font-weight: 400;
        }
        
        .back-to-dashboard {
            display: inline-flex;
            align-items: center;
            margin-bottom: 1.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        
        .back-to-dashboard i {
            margin-right: 0.5rem;
        }
        
        .back-to-dashboard:hover {
            color: #2a75e6;
        }
        
        .profile-container {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }
        
        .profile-identity {
            display: flex;
            align-items: center;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            font-weight: 600;
            font-size: 2.5rem;
            overflow: hidden;
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-info h2 {
            font-size: 1.75rem;
            margin: 0 0 0.5rem;
            color: var(--dark);
        }
        
        .profile-info p {
            color: var(--gray-600);
            margin: 0 0 0.5rem;
        }
        
        .profile-meta {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            color: var(--gray-600);
            font-size: 0.875rem;
        }
        
        .meta-item i {
            margin-right: 0.5rem;
            color: var(--primary);
        }
        
        .profile-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .profile-section {
            margin-bottom: 2rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .info-item {
            margin-bottom: 1rem;
        }
        
        .info-label {
            font-size: 0.875rem;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            font-weight: 500;
            color: var(--dark);
        }
        
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }
            
            .profile-identity {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1.5rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="logo-text">
                    <h2>MediCare Pro</h2>
                    <span>Doctor Portal</span>
                </div>
            </div>
            
            <!-- Doctor Profile in Sidebar -->
            <div class="doctor-profile">
                <div class="doctor-avatar-container">
                    <div class="doctor-avatar">
                        <?php 
                        $fullName = Auth::guard('doctor')->user()->first_name . ' ' . Auth::guard('doctor')->user()->last_name;
                        $initials = '';
                        $nameParts = explode(' ', $fullName);
                        foreach ($nameParts as $part) {
                            $initials .= strtoupper(substr($part, 0, 1));
                        }
                        echo substr($initials, 0, 2);
                        ?>
                    </div>
                    <div class="doctor-info">
                        <h3 class="doctor-name">Dr. {{ Auth::guard('doctor')->user()->first_name }} {{ Auth::guard('doctor')->user()->last_name }}</h3>
                        <p class="doctor-specialty">
                            @php
                                $specialties = explode(',', Auth::guard('doctor')->user()->specialties);
                                $formattedSpecialties = array_map(function($specialty) {
                                    return ucfirst(trim($specialty));
                                }, $specialties);
                                echo implode(', ', $formattedSpecialties);
                            @endphp
                        </p>
                    </div>
                </div>
                
                <div class="profile-actions">
                    <a href="{{ route('doctor.docprofile') }}" class="profile-link active">
                        <i class="fas fa-user"></i> View Profile
                    </a>
                    <a href="{{ route('doctor.logout') }}" class="profile-link logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="{{ route('doctor.dashboard') }}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('doctor.calendar') }}" class="nav-link">
                        <i class="fas fa-calendar-check"></i>
                        Appointments
                    </a>
                </div>
                
               
                
                <div class="nav-item">
                    <a href="{{ route('doctor.analytics') }}" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>Doctor Profile</h1>
                    <h2>Your professional profile and information</h2>
                </div>
                <div class="section-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </header>
            
            <!-- Back to Dashboard Button -->
            <a href="{{ route('doctor.dashboard') }}" class="back-to-dashboard">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            
            <div class="profile-container">
                <div class="profile-header">
                    <div class="profile-identity">
                        <div class="profile-avatar">
                            <?php 
                            $fullName = Auth::guard('doctor')->user()->first_name . ' ' . Auth::guard('doctor')->user()->last_name;
                            $initials = '';
                            $nameParts = explode(' ', $fullName);
                            foreach ($nameParts as $part) {
                                $initials .= strtoupper(substr($part, 0, 1));
                            }
                            echo substr($initials, 0, 2);
                            ?>
                        </div>
                        <div class="profile-info">
                            <h2>Dr. {{ Auth::guard('doctor')->user()->first_name }} {{ Auth::guard('doctor')->user()->last_name }}</h2>
                            <p>
                                @php
                                    $specialties = explode(',', Auth::guard('doctor')->user()->specialties);
                                    $formattedSpecialties = array_map(function($specialty) {
                                        return ucfirst(trim($specialty));
                                    }, $specialties);
                                    echo implode(', ', $formattedSpecialties);
                                @endphp
                            </p>
                            <div class="profile-meta">
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    {{ Auth::guard('doctor')->user()->status }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="profile-content">
                    <div class="profile-main">
                        <section class="profile-section">
                            <h3 class="section-title">Professional Information</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Specialization</div>
                                    <div class="info-value">
                                        @php
                                            $specialties = explode(',', Auth::guard('doctor')->user()->specialties);
                                            $formattedSpecialties = array_map(function($specialty) {
                                                return ucfirst(trim($specialty));
                                            }, $specialties);
                                            echo implode(', ', $formattedSpecialties);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                        <section class="profile-section">
                            <h3 class="section-title">Contact Information</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Email</div>
                                    <div class="info-value">{{ Auth::guard('doctor')->user()->email }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Phone</div>
                                    <div class="info-value">{{ Auth::guard('doctor')->user()->phone }}</div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>