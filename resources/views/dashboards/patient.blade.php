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
            display: flex;
        }

        .sidebar {
            width: 230px;
            background-color: #003366;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile {
            text-align: center;
            padding: 25px 20px 15px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .profile .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 28px;
            color: #888;
        }

        .profile h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile p {
            font-size: 0.9rem;
            color: #777;
        }

        .nav-links {
            flex-grow: 1;
        }

        .nav-links a {
            display: block;
            color: #fff;
            padding: 15px 25px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #005b96;
        }

        .nav-links a i {
            margin-right: 10px;
        }

        .logout-button {
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            text-align: center;
        }

        .logout-button button {
            background-color: #e0f0ff;
            color: #003366;
            border: none;
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button button:hover {
            background-color: #cce7ff;
        }

        .main-content {
            margin-left: 230px;
            width: calc(100% - 230px);
        }

        .navbar {
            background-color: #003366;
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            color: #fff;
        }

        .navbar a {
            color: #fff;
            margin-left: 1rem;
            text-decoration: none;
            background-color: #005b96;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
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

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <!-- Profile Section -->
        <div class="profile">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <h4>{{ \Illuminate\Support\Str::limit(Auth::user()->name, 20) }}</h4>
            <p>{{ Auth::user()->email }}</p>
        </div>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="{{ route('patient.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="{{ route('appointments.calendar') }}"><i class="fas fa-calendar-check"></i> My Appointments</a>
            <a href="{{ route('medical.history') }}"><i class="fas fa-notes-medical"></i> Medical History</a>
            <a href="{{ route('patient.settings') }}"><i class="fas fa-user-cog"></i> Settings</a>
        </div>

        <!-- Logout Button -->
        <div class="logout-button">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Log out</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="navbar">
            <a href="{{ route('appointment.page') }}"><i class="fas fa-calendar-plus"></i> Book Appointment</a>
        </div>

        <div class="dashboard">
            <div class="top-card">
                <h2>Welcome, {{ Auth::user()->name }}</h2>
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

</body>
</html>
