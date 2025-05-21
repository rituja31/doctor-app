<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background: url('/images/bg.jpg') no-repeat center center/cover;
            height: 100vh;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 20px;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            z-index: 2;
            position: relative;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .nav-link {
            color: #fff !important;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <div class="ms-auto">
                <a href="{{ route('login') }}" class="nav-link d-inline">Login</a>
                <a href="{{ route('register') }}" class="nav-link d-inline">Register</a>
            </div>
        </div>
    </nav>

   
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-4 fw-bold">Avoid Hassles & Delays.</h1>
            <p class="lead">How is health today, Sounds like not good!</p>
            <p>Don't worry. Find your doctor online. Book as you wish with eDoc.<br>
                We offer you a free doctor channeling service. Make your appointment now.</p>
            <a href="#" class="btn btn-primary mt-3">Make Appointment</a>
           
        </div>
    </div>

</body>
</html>
