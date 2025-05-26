<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            --online-booking: #3a86ff;
            --offline-booking: #8338ec;
            --telehealth: #ff006e;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f7fb;
            color: var(--gray-800);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--white);
            padding: 1.5rem 0;
            border-right: 1px solid var(--gray-200);
            box-shadow: var(--box-shadow);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: all 0.3s ease;
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
            color: var(--white);
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

        .nav-menu {
            padding: 0 1rem;
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

        .nav-link .badge {
            margin-left: auto;
            background-color: var(--primary);
            color: white;
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
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

        .user-profile {
            display: flex;
            align-items: center;
            position: relative;
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
            margin-right: 0.75rem;
            font-weight: 600;
            cursor: pointer;
        }

        .user-info {
            margin-right: 1.5rem;
            text-align: right;
        }

        .user-name {
            font-weight: 500;
            margin: 0;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .user-role {
            color: var(--gray-600);
            font-size: 0.75rem;
            margin: 0;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-lg);
            padding: 0.5rem 0;
            min-width: 200px;
            z-index: 1000;
            display: none;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            display: block;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .user-profile:hover .dropdown-menu {
            display: block;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-lg);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            color: var(--gray-700);
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
        }

        .card-icon.appointments {
            background-color: var(--primary);
        }

        .card-icon.patients {
            background-color: var(--success);
        }

        .card-icon.messages {
            background-color: var(--info);
        }

        .card-icon.earnings {
            background-color: var(--warning);
            color: var(--dark);
        }

        .stats-value {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: var(--dark);
        }

        .stats-label {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .stats-change {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            margin-top: 0.5rem;
        }

        .stats-change.positive {
            color: var(--success);
        }

        .stats-change.negative {
            color: var(--danger);
        }

        .stats-change i {
            margin-right: 0.25rem;
        }

        /* Calendar Container */
        .calendar-container {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--dark);
        }

        .section-actions .btn {
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            border: 1px solid var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: #2a75e6;
            border-color: #2a75e6;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
        }

        .btn-outline:hover {
            background-color: var(--gray-100);
        }

        /* Calendar */
        #calendar {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
        }

        .fc-event {
            border: none;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .fc-event-online {
            background-color: var(--online-booking);
        }

        .fc-event-offline {
            background-color: var(--offline-booking);
        }

        .fc-event-telehealth {
            background-color: var(--telehealth);
        }

        .fc-daygrid-event-dot {
            display: none;
        }

        /* Legend */
        .booking-legend {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
            gap: 1.5rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: var(--gray-700);
        }

        .legend-color {
            width: 14px;
            height: 14px;
            border-radius: 3px;
            margin-right: 0.5rem;
        }

        /* Graph Container */
        .graph-container {
            margin-top: 2rem;
        }

        .graph-card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: 1.5rem;
            box-shadow: var(--box-shadow);
        }

        .graph-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .graph-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--dark);
        }

        .graph-period {
            display: flex;
            gap: 0.5rem;
        }

        .period-btn {
            padding: 0.375rem 0.75rem;
            border-radius: var(--border-radius);
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            background-color: var(--gray-100);
            border: none;
            color: var(--gray-700);
            transition: all 0.2s ease;
        }

        .period-btn.active {
            background-color: var(--primary);
            color: var(--white);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 220px;
            }
            .main-content {
                margin-left: 220px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .user-profile {
                margin-top: 1rem;
            }
            .menu-toggle {
                display: block;
                margin-right: 1rem;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.5s ease forwards;
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
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
    <nav class="nav-menu">
        <div class="nav-item">
            <a href="{{ route('doctor.dashboard') }}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>
        
        <div class="nav-item">
            <a href="{{ route('doctor.calendar') }}" class="nav-link {{ request()->routeIs('doctor.calendar') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                Appointments
                <span class="badge">5</span>
            </a>
        </div>
        
        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-user-injured"></i>
                Patients
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('doctor.analytics') }}" class="nav-link {{ request()->routeIs('doctor.analytics') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                Analytics
            </a>
        </div>

        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </div>
    </nav>
</aside>     <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>Doctor Dashboard</h1>
                    <h2>Welcome back, Dr. {{ Auth::user()->name }}</h2>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">DR</div>
                    <div class="user-info">
                        <p class="user-name">Dr. {{ Auth::user()->name }}</p>
                        <p class="user-role">Cardiologist</p>
                    </div>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-question-circle"></i> Help
                        </a>
                  <div class="dropdown-divider"></div>
<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

            </header>
<div class="dashboard-grid">
    <a href="{{ route('doctor.calendar') }}" class="card" style="text-decoration: none; color: inherit;">
        <div class="card-header">
            <h3 class="card-title">Today's Appointments</h3>
            <div class="card-icon appointments">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
        <div class="stats-value">5</div>
        <div class="stats-label">Scheduled for today</div>
        <div class="stats-change positive">
            <i class="fas fa-arrow-up"></i> 2 from yesterday
        </div>
    </a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Active Patients</h3>
                        <div class="card-icon patients">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                    <div class="stats-value">128</div>
                    <div class="stats-label">Under your care</div>
                    <div class="stats-change positive">
                        <i class="fas fa-arrow-up"></i> 8 this month
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Unread Messages</h3>
                        <div class="card-icon messages">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>
                    <div class="stats-value">3</div>
                    <div class="stats-label">Require attention</div>
                    <div class="stats-change negative">
                        <i class="fas fa-arrow-down"></i> 2 since yesterday
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Monthly Earnings</h3>
                        <div class="card-icon earnings">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stats-value">$8,420</div>
                    <div class="stats-label">Estimated revenue</div>
                    <div class="stats-change positive">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>
            </div>

            <div class="calendar-container">
                <div class="section-header">
                    <h2 class="section-title">Appointment Calendar</h2>
                    <div class="section-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Appointment
                        </button>
                    </div>
                </div>
                <div id="calendar"></div>
                <div class="booking-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--online-booking);"></div>
                        <span>Online Booking</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--offline-booking);"></div>
                        <span>Offline Booking</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: var(--telehealth);"></div>
                        <span>Telehealth</span>
                    </div>
                </div>
            </div>

            <div class="graph-container">
                <div class="graph-card">
                    <div class="graph-header">
                        <h2 class="graph-title">Appointments Overview</h2>
                        <div class="graph-period">
                            <button class="period-btn">Day</button>
                            <button class="period-btn active">Week</button>
                            <button class="period-btn">Month</button>
                            <button class="period-btn">Year</button>
                        </div>
                    </div>
                    <canvas id="appointmentGraph"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calendar initialization
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'John Smith - Checkup',
                        start: new Date().toISOString().split('T')[0] + 'T09:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T09:30:00',
                        className: 'fc-event-online',
                        extendedProps: {
                            type: 'online',
                            patientId: 101
                        }
                    },
                    {
                        title: 'Sarah Johnson - Follow-up',
                        start: new Date().toISOString().split('T')[0] + 'T11:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T11:45:00',
                        className: 'fc-event-telehealth',
                        extendedProps: {
                            type: 'telehealth',
                            patientId: 102
                        }
                    },
                    {
                        title: 'Michael Brown - Consultation',
                        start: new Date().toISOString().split('T')[0] + 'T14:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T14:30:00',
                        className: 'fc-event-offline',
                        extendedProps: {
                            type: 'offline',
                            patientId: 103
                        }
                    },
                    {
                        title: 'Emily Davis - Annual Physical',
                        start: new Date(Date.now() + 86400000).toISOString().split('T')[0] + 'T10:00:00',
                        end: new Date(Date.now() + 86400000).toISOString().split('T')[0] + 'T10:45:00',
                        className: 'fc-event-online',
                        extendedProps: {
                            type: 'online',
                            patientId: 104
                        }
                    },
                    {
                        title: 'Robert Wilson - Post-Op',
                        start: new Date(Date.now() + 86400000).toISOString().split('T')[0] + 'T15:30:00',
                        end: new Date(Date.now() + 86400000).toISOString().split('T')[0] + 'T16:15:00',
                        className: 'fc-event-offline',
                        extendedProps: {
                            type: 'offline',
                            patientId: 105
                        }
                    }
                ],
                eventClick: function(info) {
                    alert('Appointment with ' + info.event.title + '\nType: ' +
                          info.event.extendedProps.type.toUpperCase() + ' booking');
                },
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }
            });
            calendar.render();

            // Line graph configuration
            var ctx = document.getElementById('appointmentGraph').getContext('2d');
            var appointmentGraph = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        {
                            label: 'Completed',
                            data: [12, 15, 10, 18, 14, 8, 5],
                            borderColor: 'rgba(58, 134, 255, 1)',
                            backgroundColor: 'rgba(58, 134, 255, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Scheduled',
                            data: [8, 10, 12, 9, 16, 10, 6],
                            borderColor: 'rgba(131, 56, 236, 1)',
                            backgroundColor: 'rgba(131, 56, 236, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Cancelled',
                            data: [2, 1, 3, 2, 1, 0, 1],
                            borderColor: 'rgba(255, 0, 110, 1)',
                            backgroundColor: 'rgba(255, 0, 110, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                stepSize: 5
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    elements: {
                        point: {
                            radius: 4,
                            hoverRadius: 6
                        }
                    }
                }
            });

            // Period buttons functionality
            const periodButtons = document.querySelectorAll('.period-btn');
            periodButtons.forEach(button => {
                button.addEventListener('click', () => {
                    periodButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    // Here you would update the chart data based on the selected period
                });
            });
        });
    </script>
</body>
</html>