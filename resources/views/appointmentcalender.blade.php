<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e9eef5;
            font-family: Arial, sans-serif;
        }

        .back-button-container {
            max-width: 90%;
            margin: 30px auto 10px auto;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #1792d3;
        }

        .calendar-container {
            max-width: 90%;
            margin: 10px auto 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        #calendar {
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="back-button-container">
        <a href="{{ route('patient.dashboard') }}" class="back-button">← Back to Dashboard</a>
    </div>

    <div class="calendar-container">
        <div id="calendar"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
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
