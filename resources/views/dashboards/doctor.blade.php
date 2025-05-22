<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoveCare - Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #e63946;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 8px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: var(--dark);
            margin: 0;
            padding: 0;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background: white;
            padding: 20px 0;
            border-right: 1px solid #e0e0e0;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 20px 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .logo i {
            color: var(--primary);
            font-size: 24px;
            margin-right: 10px;
        }

        .logo h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .nav-menu {
            padding: 0 15px;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: var(--secondary);
            text-decoration: none;
            border-radius: var(--border-radius);
        }

        .nav-link.active {
            background-color: rgba(230, 57, 70, 0.1);
            color: var(--primary);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header-title h1 {
            font-size: 24px;
            margin: 0;
        }

        .header-title h2 {
            font-size: 16px;
            color: var(--secondary);
            margin: 5px 0 0;
            font-weight: normal;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: 600;
        }

        .user-name {
            font-weight: 500;
            margin-right: 15px;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .logout-btn i {
            margin-right: 5px;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .card-actions i {
            color: var(--secondary);
        }

        .stats-value {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary);
            margin: 10px 0;
        }

        .stats-label {
            color: var(--secondary);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-profile {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h2>LoveCare</h2>
            </div>
            
            <nav class="nav-menu">
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-calendar-check"></i>
                        Appointments
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-title">
                    <h1>LoveCare</h1>
                    <h2>Dashboard Overview</h2>
                </div>
                
                <div class="user-profile">
                    <div class="user-avatar">DR</div>
                    <span class="user-name">Dr. {{ Auth::user()->name }}</span>
                    <button class="logout-btn" onclick="document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>
            
            <!-- Stats Overview -->
            <div class="dashboard-grid">
                <a href="#" class="card">
                    <div class="card-header">
                        <div class="card-title">Today's Appointments</div>
                        <div class="card-actions">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                    <div class="stats-value">5</div>
                    <div class="stats-label">Click to view details</div>
                </a>
                
                <a href="#" class="card">
                    <div class="card-header">
                        <div class="card-title">Active Patients</div>
                        <div class="card-actions">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                    <div class="stats-value">128</div>
                    <div class="stats-label">Under your care</div>
                </a>
                
                <a href="#" class="card">
                    <div class="card-header">
                        <div class="card-title">Unread Messages</div>
                        <div class="card-actions">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="stats-value">3</div>
                    <div class="stats-label">Waiting for reply</div>
                </a>
            </div>
        </main>
    </div>
</body>
</html>