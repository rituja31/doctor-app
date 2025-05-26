<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            background-color: #1f3557;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .navbar .nav-links {
            display: flex;
            gap: 25px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #00c4ff;
        }

        .login-register-btn {
            border: 2px solid #00c4ff;
            padding: 6px 15px;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .login-register-btn:hover {
            background-color: #00c4ff;
            color: #fff;
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

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="navbar">
    <div class="nav-links">
        <a href="#home">Home</a>
        <a href="#about">About Us</a>
        <a href="#contact">Contact</a>
    </div>
    <div>
        <a href="{{ route('login') }}" class="login-register-btn">Login/Register</a>
    </div>
</div>

<div class="hero-section" id="home">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Avoid Hassles & Delays.</h1>
        <p>How is health today, Sounds like not good!</p>
        <p>Don't worry. Find your doctor online. Book as you wish with Health Care.<br>
            We offer you a free doctor channeling service. Make your appointment now.</p>

        <a href="{{ route('appointment.page') }}" class="btn-primary">Book Appointment</a>

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

<!-- Optional: Add sections for About Us and Contact -->
<div id="about" style="padding: 100px 20px; background: #f9f9f9; text-align: center;">
    <h2>About Us</h2>
    <p>We aim to make healthcare accessible and stress-free for everyone.</p>
</div>

<div id="contact" style="padding: 100px 20px; background: #eee; text-align: center;">
    <h2>Contact</h2>
    <p>Email: support@healthcare.com | Phone: +1 234 567 890</p>
</div>

</body>
</html>
