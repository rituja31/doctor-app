<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments Calendar | MediCare</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2a7fba;
            --primary-dark: #1e6a9b;
            --secondary-color: #4b5e6d;
            --accent-color: #e0f2fe;
            --light-color: #f8fafc;
            --dark-color: #1f2a44;
            --text-color: #2d3748;
            --text-light: #64748b;
            --white: #ffffff;
            --success: #28a745;
            --warning: #f59e0b;
            --danger: #dc3545;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 12px 24px rgba(0, 0, 0, 0.12);
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
            min-height: 100vh;
            padding: 30px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            padding: 30px;
            transition: var(--transition);
        }

        .dashboard-container:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }

        .header-section .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 1px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background-color: var(--primary-color);
            color: var(--white);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .back-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .back-button i {
            margin-right: 8px;
        }

        .filter-section {
            background-color: var(--light-color);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-sm);
        }

        .filter-section .filter-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-right: 15px;
        }

        .filter-section select {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
            border: 1px solid #d1d5db;
            background-color: var(--white);
            transition: var(--transition);
        }

        .filter-section select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(42, 127, 186, 0.1);
            outline: none;
        }

        .calendar-container {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        #calendar {
            padding: 15px;
        }

        .fc-toolbar-title {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.6rem;
        }

        .fc-button {
            background-color: var(--white) !important;
            border: 1px solid #d1d5db !important;
            color: var(--secondary-color) !important;
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-weight: 500 !important;
            transition: var(--transition) !important;
            text-transform: capitalize;
        }

        .fc-button:hover {
            background-color: var(--accent-color) !important;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm) !important;
        }

        .fc-button-active {
            background-color: var(--primary-color) !important;
            color: var(--white) !important;
            border-color: var(--primary-color) !important;
        }

        .fc-daygrid-event, .fc-timegrid-event {
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.4));
            border: none;
        }

        .fc-daygrid-event:hover, .fc-timegrid-event:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .fc-event-title::before {
            content: '\f073';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 8px;
            font-size: 0.85rem;
        }

        .fc-daygrid-day-number {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1rem;
        }

        .fc-day-today {
            background-color: rgba(42, 127, 186, 0.1) !important;
            border-radius: 8px;
        }

        .fc-timegrid-slot-label {
            font-weight: 500;
            color: var(--text-light);
        }

        .fc-col-header-cell {
            background-color: var(--light-color);
            font-weight: 600;
            color: var(--secondary-color);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .dashboard-container {
                padding: 20px;
            }

            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .back-button {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }

            .fc-toolbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .fc-toolbar-chunk {
                width: 100%;
                text-align: center;
            }

            .filter-section {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .fc-toolbar-title {
                font-size: 1.4rem;
            }

            .fc-button {
                padding: 6px 12px !important;
                font-size: 0.85rem !important;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .filter-section select {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header-section">
            <div>
                <span class="logo">MediCare</span>
                <h1 class="page-title">Appointments Calendar</h1>
            </div>
            <a href="{{ route('patient.dashboard') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="filter-section">
            <div class="d-flex align-items-center flex-wrap">
                <span class="filter-label"><i class="fas fa-funnel-dollar me-2"></i> Filter Appointments</span>
                <select class="form-select" disabled>
                    <option>All Appointments</option>
                    <option>Upcoming</option>
                    <option>Past</option>
                </select>
            </div>
        </div>

        <div class="calendar-container">
            <div id="calendar"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,dayGridMonth,timeGridWeek,listWeek'
                },
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                allDaySlot: false,
                events: [
                    { title: 'sdfsdaf', start: '2025-04-30T10:20:00', color: 'orange' },
                    { title: '9859149', start: '2025-05-01T10:10:00', color: 'green' },
                    { title: 'tf', start: '2025-05-05T13:30:00', color: 'orange' },
                    { title: 'tf', start: '2025-05-06T13:30:00', color: 'green' },
                    { title: 'ssss', start: '2025-05-13T10:00:00', color: 'orange' },
                    { title: 'ok details her', start: '2025-05-13T11:05:00', color: 'orange' },
                    { title: 'No', start: '2025-05-17T13:00:00', color: 'orange' },
                    { title: 'great', start: '2025-05-20T06:59:00', color: 'red' },
                    { title: 'testmbb', start: '2025-05-20T08:00:00', color: 'red' },
                    { title: 'fdsfgfg', start: '2025-05-20T08:00:00', color: 'red' },
                    { title: 'hjjhjh', start: '2025-05-22T11:20:00', color: 'red' },
                    { title: 'hhhhhhhhhhh', start: '2025-05-27T16:50:00', color: 'orange' },
                    { title: 'bgf', start: '2025-05-28T13:15:00', color: 'green' },
                    { title: 'uuuu', start: '2025-05-29T11:00:00', color: 'orange' },
                    { title: "sdfghjk;'", start: '2025-05-30T09:00:00', color: 'orange' }
                ]
            });

            calendar.render();
        });
    </script>
</body>
</html>