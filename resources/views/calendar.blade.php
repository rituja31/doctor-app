<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .back-button {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 12px;
            background-color: #e63946;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .filter-section {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<a href="{{ route('doctor.dashboard') }}" class="back-button">← Back to Dashboard</a>


<div class="filter-section">
    <label for="filter-type">Filter by Type:</label>
    <select id="filter-type">
        <option value="all">All</option>
        <option value="online">Online</option>
        <option value="offline">Offline</option>
    </select>
</div>

<div id="calendar"></div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    const allEvents = [
        {
            title: 'Razak Nadaf - Checkup',
            start: '2025-05-25T09:00:00',
            end: '2025-05-25T09:30:00',
            className: 'online',
            extendedProps: { type: 'online' }
        },
        {
            title: 'Noor Hussain - Follow-up',
            start: '2025-05-25T11:00:00',
            end: '2025-05-25T11:45:00',
            className: 'online',
            extendedProps: { type: 'online' }
        },
        {
            title: 'Sabana Nadaf - Consultation',
            start: '2025-05-25T14:00:00',
            end: '2025-05-25T14:30:00',
            className: 'offline',
            extendedProps: { type: 'offline' }
        }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: allEvents
        });
        calendar.render();

        document.getElementById('filter-type').addEventListener('change', function() {
            const selected = this.value;
            const filteredEvents = selected === 'all' 
                ? allEvents 
                : allEvents.filter(e => e.extendedProps.type === selected);

            calendar.removeAllEvents();
            filteredEvents.forEach(e => calendar.addEvent(e));
        });
    });
</script>

</body>
</html>
