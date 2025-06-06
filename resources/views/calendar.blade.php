
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Appointment Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2a7fba;
            --secondary-color: #4b5e6d;
            --online-color: #28a745;
            --offline-color: #dc3545;
            --hover-color: #e9ecef;
            --accent-color: #f1f3f5;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #e1e7ef 100%);
            color: #2d3748;
            padding: 30px;
            margin: 0;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .dashboard-container:hover {
            transform: translateY(-2px);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
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
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #1e6a9b;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .back-button i {
            margin-right: 8px;
        }

        .filter-section {
            background-color: var(--accent-color);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .filter-section select {
            border-radius: 8px;
            padding: 10px;
            font-size: 0.95rem;
            border: 1px solid #d1d5db;
            transition: border-color 0.3s ease;
        }

        .filter-section select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(42, 127, 186, 0.1);
            outline: none;
        }

        #calendar {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .fc-toolbar-title {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .fc-button {
            background-color: white !important;
            border: 1px solid #d1d5db !important;
            color: var(--secondary-color) !important;
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .fc-button:hover {
            background-color: var(--hover-color) !important;
            transform: translateY(-1px);
        }

        .fc-button-active {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }

        .fc-daygrid-event {
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .fc-daygrid-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .online {
            background-color: var(--online-color);
            border-color: var(--online-color);
            color: white;
        }

        .offline {
            background-color: var(--offline-color);
            border-color: var(--offline-color);
            color: white;
        }

        .fc-event-time {
            font-weight: 600;
        }

        .fc-daygrid-day-number {
            color: var(--secondary-color);
            font-weight: 500;
        }

        .fc-day-today {
            background-color: rgba(42, 127, 186, 0.15) !important;
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            background-color: var(--accent-color);
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .modal-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            border-top: 1px solid #e9ecef;
        }

        .badge {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .back-button {
                width: 100%;
                justify-content: center;
            }

            .fc-toolbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .fc-toolbar-chunk {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header-section">
            <h1 class="page-title">Doctor's Appointment Calendar</h1>
            <a href="{{ route('doctor.dashboard') }}" class="back-button">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="filter-section">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <span class="fw-bold text-secondary"><i class="bi bi-funnel me-2"></i> Filter Appointments</span>
                </div>
                <div class="col-md-4">
                    <select id="filter-type" class="form-select">
                        <option value="all">All Appointments</option>
                        <option value="online">Online Consultations</option>
                        <option value="offline">Offline Visits</option>
                    </select>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge bg-success me-2"><i class="bi bi-laptop me-1"></i> Online</span>
                    <span class="badge bg-danger"><i class="bi bi-geo-alt me-1"></i> Offline</span>
                </div>
            </div>
        </div>

        <div id="calendar"></div>
    </div>

    <!-- Appointment Details Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Appointment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <h6 id="patientName" class="fw-bold"></h6>
                        <div id="appointmentTime" class="text-muted small mb-2"></div>
                        <span id="appointmentType" class="badge"></span>
                    </div>
                    <div class="mb-3">
                        <p class="fw-bold mb-1">Patient ID:</p>
                        <p id="patientId" class="text-muted"></p>
                    </div>
                    <div>
                        <p class="fw-bold mb-1">Notes:</p>
                        <p id="appointmentNotes" class="text-muted"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));

            // Dynamic events from Laravel
            const allEvents = @json($appointments);

            // Initialize calendar
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek'
                },
                initialDate: '{{ now()->format('Y-m-d') }}', // Current date
                navLinks: true,
                editable: false,
                dayMaxEvents: true,
                events: allEvents,
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                allDaySlot: false,
                eventContent: function(arg) {
                    let icon = arg.event.classNames.includes('fc-event-online') 
                        ? '<i class="bi bi-laptop me-1"></i>' 
                        : '<i class="bi bi-geo-alt me-1"></i>';
                    
                    return {
                        html: icon + arg.event.title
                    };
                },
                eventClick: function(info) {
                    // Populate modal with event data
                    document.getElementById('patientName').textContent = info.event.extendedProps.patientName;
                    document.getElementById('patientId').textContent = info.event.id;
                    document.getElementById('appointmentNotes').textContent = info.event.extendedProps.notes || 'No notes provided.';
                    
                    // Format date/time
                    const options = { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    const timeString = info.event.start.toLocaleDateString('en-US', options) + 
                                     ' - ' + 
                                     info.event.end.toLocaleTimeString('en-US', {hour: '2-digit', minute:'2-digit'});
                    document.getElementById('appointmentTime').textContent = timeString;
                    
                    // Set appointment type badge
                    const typeBadge = document.getElementById('appointmentType');
                    typeBadge.textContent = info.event.extendedProps.type === 'online' ? 'Online' : 'Offline';
                    typeBadge.className = 'badge ' + (info.event.extendedProps.type === 'online' ? 'bg-success' : 'bg-danger');
                    
                    // Show modal
                    appointmentModal.show();
                }
            });
            
            calendar.render();

            // Filter functionality
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
