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
            --card-padding: 1.5rem;
            --icon-size: 48px;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
            display: flex;
            flex-direction: column;
        }
        .doctor-profile {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .doctor-avatar-container {
            display: flex;
            flex-direction: column;
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
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .doctor-info {
            display: flex;
            flex-direction: column;
            align-items: center;
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
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .profile-link {
            display: flex;
            align-items: center;
            color: var(--gray-700);
            text-decoration: none;
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
            transition: color 0.2s ease;
            border-radius: var(--border-radius);
        }
        .profile-link:hover {
            background-color: var(--primary-light);
            color: var(--gray-900);
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
        #logout-form {
            margin: 0;
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
            color: var(--gray-900);
        }
        .nav-link.active {
            color: var(--gray-900);
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
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 1.5rem;
            transition: all 0.3s ease;
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
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--white);
            border-radius: var(--border-radius-lg);
            padding: var(--card-padding);
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid var(--gray-200);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow-lg);
        }
        .stat-icon {
            width: var(--icon-size);
            height: var(--icon-size);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: var(--white);
            transition: transform 0.2s ease;
        }
        .stat-icon.appointments {
            background: linear-gradient(135deg, var(--primary), #2b6cb0);
        }
        .stat-icon.earnings {
            background: linear-gradient(135deg, var(--success), #218838);
        }
        .stat-card:hover .stat-icon {
            transform: scale(1.1);
        }
        .stat-content h3 {
            font-size: 0.95rem;
            color: var(--gray-600);
            margin: 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .stat-content p {
            font-size: 1.5rem;
            color: var(--dark);
            margin: 0.25rem 0 0;
            font-weight: 600;
        }
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
        .fc-daygrid-event-dot {
            display: none;
        }
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
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .menu-toggle {
                display: block;
                margin-right: 1rem;
                font-size: 1.5rem;
                cursor: pointer;
            }
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="doctor-profile">
            <div class="doctor-avatar-container">
                <div class="doctor-avatar">
                    @php
                        $fullName = Auth::guard('doctor')->user()->first_name . ' ' . Auth::guard('doctor')->user()->first_name;
                        $initials = '';
                        $nameParts = explode(' ', $fullName);
                        foreach ($nameParts as $part) {
                            $initials .= strtoupper(substr($part, 0, 1));
                        }
                        echo substr($initials, 0, 2);
                    @endphp
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Dr. {{ Auth::guard('doctor')->user()->first_name }} {{ Auth::guard('doctor')->user()->last_name }}</h3>
                    <p class="doctor-specialty">
                        @php
                            echo ucfirst(explode(',', Auth::guard('doctor')->user()->specialties)[0]);
                        @endphp
                    </p>
                </div>
            </div>
            <div class="profile-actions">
                <a href="{{ route('doctor.docprofile') }}" class="nav-link {{ request()->routeIs('doctor.docprofile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> View Profile
                </a>
                <a class="profile-link logout-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
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
                    <span class="badge">{{ $appointments->count() }}</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('doctor.analytics') }}" class="nav-link {{ request()->routeIs('doctor.analytics') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    Analytics
                </a>
            </div>
        </nav>
    </aside>
    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Doctor Dashboard</h1>
                <h2>Welcome back, Dr. {{ Auth::guard('doctor')->user()->first_name }} {{ Auth::guard('doctor')->user()->last_name }}</h2>
            </div>
            <div class="section-actions">
                <button class="btn btn-primary">
                    <i class="fas fa-bell"></i>
                </button>
            </div>
        </header>
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon appointments">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Appointments</h3>
                    <p>{{ $totalAppointments }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon earnings">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>Monthly Earnings</h3>
                    <p>₹{{ number_format($monthlyEarnings, 2, '.', ',') }}</p>
                </div>
            </div>
        </div>
        <div class="calendar-container">
            <div class="section-header">
                <h2 class="section-title">Appointment Calendar</h2>
                <div class="section-actions"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calendar initialization
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'Asia/Kolkata',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: @json($appointments),
                eventClick: function(info) {
                    alert('Appointment with ' + info.event.extendedProps.patientName + 
                          '\nType: ' + info.event.extendedProps.type.toUpperCase() + ' booking' +
                          '\nTime: ' + info.event.extendedProps.time_formatted);
                },
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },
                eventDidMount: function(info) {
                    info.el.querySelector('.fc-event-time').textContent = 
                        info.event.extendedProps.time_formatted;
                }
            });
            calendar.render();

            // Line graph configuration
            var ctx = document.getElementById('appointmentGraph').getContext('2d');
            var appointmentGraph = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($days),
                    datasets: [
                        {
                            label: 'Online',
                            data: @json($onlineData),
                            borderColor: 'rgba(58, 134, 255, 1)',
                            backgroundColor: 'rgba(58, 134, 255, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Offline',
                            data: @json($offlineData),
                            borderColor: 'rgba(131, 56, 236, 1)',
                            backgroundColor: 'rgba(131, 56, 236, 0.1)',
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
                                stepSize: 1
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

            // Period buttons (placeholder for future dynamic updates)
            const periodButtons = document.querySelectorAll('.period-btn');
            periodButtons.forEach(button => {
                button.addEventListener('click', () => {
                    periodButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    // TODO: Add AJAX to update graph data based on period
                });
            });
        });
    </script>
</body>
</html>