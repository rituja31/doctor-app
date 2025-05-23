<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Patient Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }

        .navbar {
            position: sticky;
            top: 0;
            background-color: rgb(3, 38, 72);
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            z-index: 1000;
        }

        .navbar a, .navbar form button {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-size: 1rem;
            background-color: #007bff;
            padding: 8px 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .navbar a:hover, .navbar form button:hover {
            background-color: #0056b3;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 60px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container h2 {
            margin-bottom: 20px;
            color: rgb(3, 38, 72);
        }

        .profile-info {
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .profile-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ route('patient.appointments.create') }}">Book Appointment</a>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="dashboard-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>

        <div class="profile-info">
            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

        <a href="{{ route('patient.appointments.create') }}" class="btn-primary">Make a New Appointment</a>
    </div>

</body>
</html>
