<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Doctor Appointment</title>
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
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgb(3, 38, 72);
            padding: 10px 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            z-index: 1000;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #f8f9fb;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            user-select: none;
        }

        .username {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 8px 18px;
            font-size: 1rem;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .hero-section {
            background: url('/images/bg2.jpg') no-repeat center center/cover;
            height: 100vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            z-index: 2;
            position: relative;
            max-width: 700px;
        }

        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .dashboard-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        form.logout-form {
            display: inline;
        }

        @media (max-width: 600px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        @auth
            <div class="user-info">
                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="username">
                    {{ Auth::user()->name }}
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn-primary">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn-primary">Register</a>
        @endauth
    </div>

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Avoid Hassles & Delays.</h1>
            <p>How is health today, Sounds like not good!</p>
            <p>Don't worry. Find your doctor online. Book as you wish with Health Care.<br>
               We offer you a free doctor channeling service. Make your appointment now.</p>

            <a href="@auth {{ route('patient.appointments.create') }} @else {{ route('login') }} @endauth" class="btn-primary">Make Appointment</a>

            @auth
                <div class="dashboard-links">
                    @if(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" class="btn-primary">Doctor Dashboard</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary">Admin Dashboard</a>
                    @else
                        <a href="{{ route('patient.dashboard') }}" class="btn-primary">Patient Dashboard</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>

</body>
</html>
