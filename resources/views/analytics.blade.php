<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Analytics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
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

        /* Sidebar styles would be the same as previous implementation */
        
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

        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
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

        .card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-btn {
            background-color: var(--gray-100);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-menu {
            position: absolute;
            right: 0;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow-lg);
            padding: 0.5rem 0;
            min-width: 160px;
            z-index: 1000;
            display: none;
        }

        .filter-menu.show {
            display: block;
        }

        .filter-item {
            padding: 0.5rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            display: block;
            transition: all 0.2s ease;
            font-size: 0.75rem;
        }

        .filter-item:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }

        .grid-col-12 {
            grid-column: span 12;
        }

        .grid-col-8 {
            grid-column: span 8;
        }

        .grid-col-6 {
            grid-column: span 6;
        }

        .grid-col-4 {
            grid-column: span 4;
        }

        .grid-col-3 {
            grid-column: span 3;
        }

        .stats-card {
            display: flex;
            flex-direction: column;
            height: 100%;
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

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        .chart-container-sm {
            height: 200px;
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 0.5rem;
        }

        .appointment-list {
            margin-top: 1rem;
        }

        .appointment-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .appointment-type {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .appointment-type.online {
            background-color: var(--online-booking);
        }

        .appointment-type.offline {
            background-color: var(--offline-booking);
        }

        .appointment-type.telehealth {
            background-color: var(--telehealth);
        }

        .appointment-details {
            flex: 1;
        }

        .appointment-patient {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .appointment-time {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .appointment-status {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
        }

        .status-completed {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
        }

        .status-cancelled {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        @media (max-width: 1200px) {
            .grid-col-8 {
                grid-column: span 12;
            }
            .grid-col-6 {
                grid-column: span 12;
            }
            .grid-col-4 {
                grid-column: span 6;
            }
        }

        @media (max-width: 768px) {
            .grid-col-4 {
                grid-column: span 12;
            }
            .grid-col-3 {
                grid-column: span 6;
            }
        }

        @media (max-width: 576px) {
            .grid-col-3 {
                grid-column: span 12;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar would be the same as previous implementation -->
        
        <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>Appointment Analytics</h1>
                    <h2>Detailed statistics and insights about your appointments</h2>
                </div>
                <div class="header-actions">
                    <div class="filter-dropdown">
                        <button class="filter-btn" id="timeFilterBtn">
                            <i class="fas fa-calendar-alt"></i>
                            Last 30 Days
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="filter-menu" id="timeFilterMenu">
                            <a href="#" class="filter-item" data-value="7">Last 7 Days</a>
                            <a href="#" class="filter-item" data-value="30">Last 30 Days</a>
                            <a href="#" class="filter-item" data-value="90">Last 90 Days</a>
                            <a href="#" class="filter-item" data-value="365">Last Year</a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="analytics-grid">
                <!-- Summary Cards -->
                <div class="card grid-col-3">
                    <div class="stats-card">
                        <div class="card-header">
                            <h3 class="card-title">Total Appointments</h3>
                            <i class="fas fa-calendar-check" style="color: var(--primary);"></i>
                        </div>
                        <div class="stats-value">142</div>
                        <div class="stats-label">All appointment types</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 12% from last period
                        </div>
                    </div>
                </div>

                <div class="card grid-col-3">
                    <div class="stats-card">
                        <div class="card-header">
                            <h3 class="card-title">Completed</h3>
                            <i class="fas fa-check-circle" style="color: var(--success);"></i>
                        </div>
                        <div class="stats-value">118</div>
                        <div class="stats-label">83% completion rate</div>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 8% from last period
                        </div>
                    </div>
                </div>

                <div class="card grid-col-3">
                    <div class="stats-card">
                        <div class="card-header">
                            <h3 class="card-title">Cancelled</h3>
                            <i class="fas fa-times-circle" style="color: var(--danger);"></i>
                        </div>
                        <div class="stats-value">14</div>
                        <div class="stats-label">10% cancellation rate</div>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-down"></i> 3% from last period
                        </div>
                    </div>
                </div>

                <div class="card grid-col-3">
                    <div class="stats-card">
                        <div class="card-header">
                            <h3 class="card-title">No Shows</h3>
                            <i class="fas fa-user-slash" style="color: var(--warning);"></i>
                        </div>
                        <div class="stats-value">10</div>
                        <div class="stats-label">7% no-show rate</div>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-up"></i> 2% from last period
                        </div>
                    </div>
                </div>

                <!-- Main Chart -->
                <div class="card grid-col-8">
                    <div class="card-header">
                        <h3 class="card-title">Appointments Trend</h3>
                        <div class="card-actions">
                            <div class="filter-dropdown">
                                <button class="filter-btn" id="chartTypeBtn">
                                    <i class="fas fa-chart-line"></i>
                                    Line Chart
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="filter-menu" id="chartTypeMenu">
                                    <a href="#" class="filter-item" data-value="line">Line Chart</a>
                                    <a href="#" class="filter-item" data-value="bar">Bar Chart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="trendChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--online-booking);"></div>
                            <span>Online</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--offline-booking);"></div>
                            <span>In-Person</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--telehealth);"></div>
                            <span>Telehealth</span>
                        </div>
                    </div>
                </div>

                <!-- Appointment Types Pie Chart -->
                <div class="card grid-col-4">
                    <div class="card-header">
                        <h3 class="card-title">Appointment Types</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="typeChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--online-booking);"></div>
                            <span>Online (42%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--offline-booking);"></div>
                            <span>In-Person (48%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: var(--telehealth);"></div>
                            <span>Telehealth (10%)</span>
                        </div>
                    </div>
                </div>

                <!-- Status Distribution -->
                <div class="card grid-col-6">
                    <div class="card-header">
                        <h3 class="card-title">Status Distribution</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #28a745;"></div>
                            <span>Completed (83%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #dc3545;"></div>
                            <span>Cancelled (10%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #ffc107;"></div>
                            <span>No Show (7%)</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Appointments -->
                <div class="card grid-col-6">
                    <div class="card-header">
                        <h3 class="card-title">Recent Appointments</h3>
                        <a href="#" class="btn btn-sm btn-outline">View All</a>
                    </div>
                    <div class="appointment-list">
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <div class="appointment-type online"></div>
                                <div class="appointment-details">
                                    <div class="appointment-patient">John Smith</div>
                                    <div class="appointment-time">Today, 09:00 AM - Follow-up</div>
                                </div>
                            </div>
                            <span class="appointment-status status-completed">Completed</span>
                        </div>
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <div class="appointment-type telehealth"></div>
                                <div class="appointment-details">
                                    <div class="appointment-patient">Sarah Johnson</div>
                                    <div class="appointment-time">Today, 11:00 AM - Consultation</div>
                                </div>
                            </div>
                            <span class="appointment-status status-pending">Pending</span>
                        </div>
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <div class="appointment-type offline"></div>
                                <div class="appointment-details">
                                    <div class="appointment-patient">Michael Brown</div>
                                    <div class="appointment-time">Today, 02:00 PM - Checkup</div>
                                </div>
                            </div>
                            <span class="appointment-status status-completed">Completed</span>
                        </div>
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <div class="appointment-type online"></div>
                                <div class="appointment-details">
                                    <div class="appointment-patient">Emily Davis</div>
                                    <div class="appointment-time">Yesterday, 10:00 AM - Annual Physical</div>
                                </div>
                            </div>
                            <span class="appointment-status status-cancelled">Cancelled</span>
                        </div>
                    </div>
                </div>

                <!-- Time Slot Popularity -->
                <div class="card grid-col-12">
                    <div class="card-header">
                        <h3 class="card-title">Time Slot Popularity</h3>
                        <div class="card-actions">
                            <div class="filter-dropdown">
                                <button class="filter-btn" id="timeSlotBtn">
                                    <i class="fas fa-clock"></i>
                                    By Hour
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <div class="filter-menu" id="timeSlotMenu">
                                    <a href="#" class="filter-item" data-value="hour">By Hour</a>
                                    <a href="#" class="filter-item" data-value="day">By Day of Week</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="height: 250px;">
                        <canvas id="timeSlotChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle filter dropdowns
            document.querySelectorAll('.filter-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const menu = this.nextElementSibling;
                    document.querySelectorAll('.filter-menu').forEach(m => {
                        if (m !== menu) m.classList.remove('show');
                    });
                    menu.classList.toggle('show');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.filter-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            });

            // Trend Chart (Main Chart)
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            const trendChart = new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Online',
                            data: [12, 15, 10, 18, 14, 20, 16, 19, 15, 22, 18, 24],
                            borderColor: 'rgba(58, 134, 255, 1)',
                            backgroundColor: 'rgba(58, 134, 255, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'In-Person',
                            data: [15, 18, 14, 20, 16, 22, 18, 24, 20, 26, 22, 28],
                            borderColor: 'rgba(131, 56, 236, 1)',
                            backgroundColor: 'rgba(131, 56, 236, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Telehealth',
                            data: [3, 4, 5, 6, 7, 8, 6, 7, 8, 9, 7, 10],
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
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
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

            // Appointment Types Pie Chart
            const typeCtx = document.getElementById('typeChart').getContext('2d');
            const typeChart = new Chart(typeCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Online', 'In-Person', 'Telehealth'],
                    datasets: [{
                        data: [42, 48, 10],
                        backgroundColor: [
                            'rgba(58, 134, 255, 1)',
                            'rgba(131, 56, 236, 1)',
                            'rgba(255, 0, 110, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            display: false
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Status Distribution Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: ['Completed', 'Cancelled', 'No Show'],
                    datasets: [{
                        data: [83, 10, 7],
                        backgroundColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(255, 193, 7, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            display: false
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Time Slot Popularity Chart
            const timeSlotCtx = document.getElementById('timeSlotChart').getContext('2d');
            const timeSlotChart = new Chart(timeSlotCtx, {
                type: 'bar',
                data: {
                    labels: ['8 AM', '9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM'],
                    datasets: [{
                        label: 'Appointments',
                        data: [8, 15, 22, 18, 12, 10, 14, 20, 16, 9],
                        backgroundColor: 'rgba(58, 134, 255, 0.7)',
                        borderColor: 'rgba(58, 134, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Filter functionality
            document.querySelectorAll('.filter-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const value = this.getAttribute('data-value');
                    const menu = this.closest('.filter-menu');
                    const btn = menu.previousElementSibling;
                    
                    // Update button text
                    if (menu.id === 'timeFilterMenu') {
                        let text = '';
                        switch(value) {
                            case '7': text = 'Last 7 Days'; break;
                            case '30': text = 'Last 30 Days'; break;
                            case '90': text = 'Last 90 Days'; break;
                            case '365': text = 'Last Year'; break;
                        }
                        btn.innerHTML = `<i class="fas fa-calendar-alt"></i> ${text} <i class="fas fa-chevron-down"></i>`;
                        
                        // Here you would update the charts with new data based on the filter
                        // For demo purposes, we'll just log the filter change
                        console.log(`Filter changed to: ${text}`);
                    }
                    
                    menu.classList.remove('show');
                });
            });
        });
    </script>
</body>
</html>