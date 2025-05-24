<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: rgb(80, 161, 243);
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 8px;
            --online-booking: #0077b6;
            --offline-booking: #ff8800;
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

        .main-content {
            flex: 1;
            padding: 20px;
        }

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

        /* Cards container stacked vertically */
        .dashboard-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
            max-width: 400px; /* optional: limit width */
        }

        .card {
            background: white;
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-decoration: none;
            color: inherit;
            display: block;
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

        .calendar-container {
            margin-top: 20px;
            max-width: 900px;
        }

        .fc-event {
            cursor: pointer;
        }

        .fc-event-online {
            background-color: var(--online-booking);
            border-color: var(--online-booking);
        }

        .fc-event-offline {
            background-color: var(--offline-booking);
            border-color: var(--offline-booking);
        }

        .booking-legend {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            gap: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
            margin-right: 5px;
        }

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
                max-width: 100%;
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
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h2>Health Care</h2>
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
        <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>Health Care</h1>
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

            <div class="dashboard-grid">
                <a href="{{ route('doctor.calendar') }}" class="card">
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

            <div class="card calendar-container">
                <div class="card-header">
                    <div class="card-title">Appointment Calendar</div>
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
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        title: 'Razak Nadaf - Checkup',
                        start: new Date().toISOString().split('T')[0] + 'T09:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T09:30:00',
                        className: 'fc-event-online',
                        extendedProps: {
                            type: 'online',
                            patientId: 101
                        }
                    },
                    {
                        title: 'Noor Hussain - Follow-up',
                        start: new Date().toISOString().split('T')[0] + 'T11:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T11:45:00',
                        className: 'fc-event-online',
                        extendedProps: {
                            type: 'online',
                            patientId: 102
                        }
                    },
                    {
                        title: 'Sabana Nadaf - Consultation',
                        start: new Date().toISOString().split('T')[0] + 'T14:00:00',
                        end: new Date().toISOString().split('T')[0] + 'T14:30:00',
                        className: 'fc-event-offline',
                        extendedProps: {
                            type: 'offline',
                            patientId: 103
                        }
                    }
                ],
                eventClick: function(info) {
                    alert('Appointment with ' + info.event.title + '\nType: ' +
                          info.event.extendedProps.type.toUpperCase() + ' booking');
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>