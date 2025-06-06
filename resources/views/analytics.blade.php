
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Analytics Dashboard</title>
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
        .main-content {
            flex: 1;
            padding: 2rem;
            transition: all 0.3s ease;
            width: 100%;
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
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
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
        .back-button {
            background-color: var(--primary-light);
            color: var(--primary);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: var(--primary);
            color: white;
        }
        .no-data {
            text-align: center;
            padding: 2rem;
            color: var(--gray-600);
            font-size: 1rem;
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
            .main-content {
                padding: 1rem;
            }
        }
        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>Appointment Analytics</h1>
                    <h2>Detailed statistics and insights about your appointments</h2>
                </div>
                <div class="header-actions">
                    <a href="{{ route('doctor.dashboard') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </header>
            @if ($recentAppointments->isEmpty() && $trendData['online']|array_sum == 0 && $trendData['offline']|array_sum == 0)
                <div class="no-data">No appointment data available.</div>
            @else
                <div class="analytics-grid">
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
                                <span>Online ({{ $typeData['online'] }}%)</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: var(--offline-booking);"></div>
                                <span>In-Person ({{ $typeData['offline'] }}%)</span>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Appointments -->
                    <div class="card grid-col-6">
                        <div class="card-header">
                            <h3 class="card-title">Recent Appointments</h3>
                            <a href="{{ route('doctor.calendar') }}" class="btn btn-sm btn-outline">View All</a>
                        </div>
                        <div class="appointment-list">
                            @forelse ($recentAppointments as $appointment)
                                <div class="appointment-item">
                                    <div class="appointment-info">
                                        <div class="appointment-type {{ $appointment['type'] }}"></div>
                                        <div class="appointment-details">
                                            <div class="appointment-patient">{{ $appointment['patient_name'] }}</div>
                                            <div class="appointment-time">{{ $appointment['day'] }}, {{ $appointment['time_formatted'] }} - {{ $appointment['details'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="no-data">No recent appointments.</div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Weekly Peak Hours -->
                    <div class="card grid-col-6">
                        <div class="card-header">
                            <h3 class="card-title">Weekly Peak Hours</h3>
                            <div class="card-actions">
                                <div class="filter-dropdown">
                                    <button class="filter-btn" id="weekFilterBtn">
                                        <i class="fas fa-filter"></i>
                                        This Week
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div class="filter-menu" id="weekFilterMenu">
                                        <a href="#" class="filter-item" data-value="this-week">This Week</a>
                                        <a href="#" class="filter-item" data-value="last-week">Last Week</a>
                                        <a href="#" class="filter-item" data-value="this-month">This Month</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="peakHoursChart"></canvas>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
    @unless ($recentAppointments->isEmpty() && $trendData['online']|array_sum == 0 && $trendData['offline']|array_sum == 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize dropdown menus
                const dropdowns = [
                    { btn: 'chartTypeBtn', menu: 'chartTypeMenu' },
                    { btn: 'weekFilterBtn', menu: 'weekFilterMenu' }
                ];
                
                dropdowns.forEach(dropdown => {
                    const btn = document.getElementById(dropdown.btn);
                    const menu = document.getElementById(dropdown.menu);
                    
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        menu.classList.toggle('show');
                    });
                    
                    document.addEventListener('click', () => {
                        menu.classList.remove('show');
                    });
                });

                // Trend Chart
                const trendCtx = document.getElementById('trendChart').getContext('2d');
                const trendChart = new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: @json($trendData['labels']),
                        datasets: [
                            {
                                label: 'Online',
                                data: @json($trendData['online']),
                                borderColor: 'rgba(58, 134, 255, 1)',
                                backgroundColor: 'rgba(58, 134, 255, 0.1)',
                                tension: 0.3,
                                fill: true
                            },
                            {
                                label: 'In-Person',
                                data: @json($trendData['offline']),
                                borderColor: 'rgba(131, 56, 236, 1)',
                                backgroundColor: 'rgba(131, 56, 236, 0.1)',
                                tension: 0.3,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { drawBorder: false } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // Type Chart
                const typeCtx = document.getElementById('typeChart').getContext('2d');
                const typeChart = new Chart(typeCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Online', 'In-Person'],
                        datasets: [{
                            data: [@json($typeData['online']), @json($typeData['offline'])],
                            backgroundColor: ['rgba(58, 134, 255, 0.8)', 'rgba(131, 56, 236, 0.8)'],
                            borderColor: ['rgba(58, 134, 255, 1)', 'rgba(131, 56, 236, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                }
                            }
                        },
                        cutout: '70%'
                    }
                });

                // Peak Hours Chart
                const peakCtx = document.getElementById('peakHoursChart').getContext('2d');
                const peakHoursChart = new Chart(peakCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($hours),
                        datasets: [{
                            label: 'Appointments',
                            data: @json($peakData),
                            backgroundColor: 'rgba(58, 134, 255, 0.7)',
                            borderColor: 'rgba(58, 134, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { drawBorder: false } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // Chart type toggle
                document.querySelectorAll('#chartTypeMenu .filter-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        const type = this.getAttribute('data-value');
                        document.getElementById('chartTypeBtn').innerHTML = 
                            `<i class="fas fa-chart-${type}"></i> ${type === 'line' ? 'Line' : 'Bar'} Chart <i class="fas fa-chevron-down"></i>`;
                        trendChart.config.type = type;
                        trendChart.update();
                        document.getElementById('chartTypeMenu').classList.remove('show');
                    });
                });

                // Week filter functionality (placeholder)
                document.querySelectorAll('#weekFilterMenu .filter-item').forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();
                        const value = this.getAttribute('data-value');
                        const label = this.textContent;
                        document.getElementById('weekFilterBtn').innerHTML = 
                            `<i class="fas fa-filter"></i> ${label} <i class="fas fa-chevron-down"></i>`;
                        console.log(`Filter changed to ${value}`);
                        document.getElementById('weekFilterMenu').classList.remove('show');
                    });
                });
            });
        </script>
    @endunless
</body>
</html>
