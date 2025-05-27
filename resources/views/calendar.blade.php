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
            --secondary-color: #6c757d;
            --online-color: #28a745;
            --offline-color: #dc3545;
            --hover-color: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }
        
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .page-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .back-button:hover {
            background-color: #1e6a9b;
            color: white;
            transform: translateY(-1px);
        }
        
        .back-button i {
            margin-right: 5px;
        }
        
        .filter-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        #calendar {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }
        
        .fc-toolbar-title {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .fc-button {
            background-color: white !important;
            border: 1px solid #ced4da !important;
            color: var(--secondary-color) !important;
            transition: all 0.2s !important;
        }
        
        .fc-button:hover {
            background-color: var(--hover-color) !important;
        }
        
        .fc-button-active {
            background-color: var(--primary-color) !important;
            color: white !important;
            border-color: var(--primary-color) !important;
        }
        
        .fc-daygrid-event {
            border-radius: 4px;
            padding: 3px 6px;
            font-size: 0.9em;
            cursor: pointer;
        }
        
        .online {
            background-color: var(--online-color);
            border-color: var(--online-color);
        }
        
        .offline {
            background-color: var(--offline-color);
            border-color: var(--offline-color);
        }
        
        .fc-event-time {
            font-weight: 500;
        }
        
        .fc-daygrid-day-number {
            color: var(--secondary-color);
        }
        
        .fc-day-today {
            background-color: rgba(42, 127, 186, 0.1) !important;
        }
        
        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .back-button {
                margin-top: 10px;
            }
            
            .fc-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .fc-toolbar-chunk {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header-section">
            <h1 class="page-title">Appointment Calendar</h1>
           <a href="{{ route('doctor.dashboard') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        </div>
        
        <div class="filter-section">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <span class="fw-bold text-secondary"><i class="bi bi-funnel"></i> Filter Appointments:</span>
                </div>
                <div class="col-md-4">
                    <select id="filter-type" class="form-select">
                        <option value="all">All Appointments</option>
                        <option value="online">Online Consultations</option>
                        <option value="offline">In-Person Visits</option>
                    </select>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <span class="badge bg-success me-2"><i class="bi bi-laptop"></i> Online</span>
                    <span class="badge bg-danger"><i class="bi bi-geo-alt"></i> Offline</span>
                </div>
            </div>
        </div>
        
        <div id="calendar"></div>
    </div>

    <!-- Appointment Details Modal -->
    <div class="modal fade" id="appointmentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
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
        // Hardcoded appointment data
        const allEvents = [
            {
                id: '1',
                title: 'John Smith - Checkup',
                start: '2023-06-01T09:00:00',
                end: '2023-06-01T09:30:00',
                className: 'online',
                extendedProps: { 
                    type: 'online',
                    patientId: 'P1001',
                    notes: 'Annual physical examination. Patient has concerns about sleep quality.'
                }
            },
            {
                id: '2',
                title: 'Emily Johnson - Follow-up',
                start: '2023-06-01T11:00:00',
                end: '2023-06-01T11:45:00',
                className: 'online',
                extendedProps: { 
                    type: 'online',
                    patientId: 'P1002',
                    notes: 'Diabetes management follow-up. Review latest blood sugar readings.'
                }
            },
            {
                id: '3',
                title: 'Michael Brown - Consultation',
                start: '2023-06-02T14:00:00',
                end: '2023-06-02T14:30:00',
                className: 'offline',
                extendedProps: { 
                    type: 'offline',
                    patientId: 'P1003',
                    notes: 'New patient consultation. Bring insurance card and medical history.'
                }
            },
            {
                id: '4',
                title: 'Sarah Wilson - Treatment',
                start: '2023-06-03T10:15:00',
                end: '2023-06-03T11:00:00',
                className: 'offline',
                extendedProps: { 
                    type: 'offline',
                    patientId: 'P1004',
                    notes: 'Post-operative check. Remove stitches and assess healing.'
                }
            },
            {
                id: '5',
                title: 'David Lee - Video Consult',
                start: '2023-06-05T13:30:00',
                end: '2023-06-05T14:00:00',
                className: 'online',
                extendedProps: { 
                    type: 'online',
                    patientId: 'P1005',
                    notes: 'Medication review. Discuss side effects of current prescription.'
                }
            },
            {
                id: '6',
                title: 'Jennifer Davis - Physical',
                start: '2023-06-06T09:30:00',
                end: '2023-06-06T10:15:00',
                className: 'offline',
                extendedProps: { 
                    type: 'offline',
                    patientId: 'P1006',
                    notes: 'Sports physical for school. Bring completed forms.'
                }
            },
            {
                id: '7',
                title: 'Robert Taylor - Follow-up',
                start: '2023-06-07T15:00:00',
                end: '2023-06-07T15:30:00',
                className: 'online',
                extendedProps: { 
                    type: 'online',
                    patientId: 'P1007',
                    notes: 'Blood pressure follow-up. Review medication effectiveness.'
                }
            }
        ];

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
            
            // Initialize calendar
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialDate: '2023-06-01',
                navLinks: true,
                editable: false,
                dayMaxEvents: true,
                events: allEvents,
                eventContent: function(arg) {
                    let icon = arg.event.classNames.includes('online') 
                        ? '<i class="bi bi-laptop me-1"></i>' 
                        : '<i class="bi bi-geo-alt me-1"></i>';
                    
                    return {
                        html: icon + arg.event.title
                    };
                },
                eventClick: function(info) {
                    // Populate modal with event data
                    document.getElementById('patientName').textContent = info.event.title;
                    document.getElementById('patientId').textContent = info.event.extendedProps.patientId;
                    document.getElementById('appointmentNotes').textContent = info.event.extendedProps.notes;
                    
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
                    typeBadge.textContent = info.event.extendedProps.type === 'online' ? 'Online' : 'In-Person';
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