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

        .contact-section {
            padding: 100px 20px;
            background: #f5f7fa;
        }

        .contact-card {
            max-width: 700px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .contact-card h2 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        .contact-card p {
            text-align: center;
            margin-bottom: 30px;
            color: #555;
        }

        .contact-card input,
        .contact-card textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-flex {
            display: flex;
            gap: 15px;
        }

        .contact-flex > div {
            flex: 1;
        }

        .contact-card button {
            background-color: #3ab4f2;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
        }

        .contact-card button:hover {
            background-color: #2196f3;
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

<!-- About Us Section -->
<div id="about" style="padding: 100px 20px; background: #f9f9f9; text-align: center;">
    <h2>About Us</h2>
    <p>We aim to make healthcare accessible and stress-free for everyone.</p>
</div>

<!-- Contact Form Section -->
<div id="contact" class="contact-section">
    <div class="contact-card">
        <h2>Contact</h2>
        <p>Get connect with us.</p>

        <form>
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" placeholder="Enter your full name" required>

            <div class="contact-flex">
                <div>
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" placeholder="Phone Number">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Email Address" required>
                </div>
            </div>

            <label for="message">Message</label>
            <textarea id="message" rows="5" placeholder="Write your message..." required></textarea>

            <div style="text-align: center;">
                <button type="submit">Send Message</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
