<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
        }

        .navbar {
            background-color: #003366;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .navbar a, .navbar button {
            color: #fff;
            margin-left: 1rem;
            text-decoration: none;
            background-color: #005b96;
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover, .navbar button:hover {
            background-color: #1792d3;
        }

        .dashboard {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .top-card {
            background-color: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .top-card h2 {
            color: #003366;
            margin-bottom: 15px;
        }

        .top-card p {
            font-size: 1.05rem;
            margin-bottom: 8px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: #003366;
        }

        .card i {
            color: #1792d3;
            margin-right: 10px;
        }

        .btn-primary {
            display: inline-block;
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1rem;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1792d3;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a, .navbar button {
                margin: 10px 0 0 0;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a>
            <a href="{{ route('appointment.page') }}"><i class="fas fa-calendar-plus"></i> Book Appointment</a>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </div>

    <div class="dashboard">

        
        <div class="top-card">
            <h2>Welcome, {{ Auth::user()->name }}</h2>
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

       
        <div class="card-grid">
            <div class="card">
                <h3><i class="fas fa-calendar-check"></i> My Appointments</h3>
                <p>View and manage your upcoming and past appointments.</p>
                <a class="btn-primary" href="{{ route('appointment.page') }}">View Appointments</a>
            </div>

            <div class="card">
                <h3><i class="fas fa-notes-medical"></i> Medical History</h3>
                <p>Review your medical records and history with doctors.</p>
                <a class="btn-primary" href="#">View History</a>
            </div>

            <div class="card">
                <h3><i class="fas fa-user-cog"></i> Settings</h3>
                <p>Update your profile, password, and notification preferences.</p>
                <a class="btn-primary" href="#">Go to Settings</a>
            </div>
        </div>
    </div>

</body>
</html>
