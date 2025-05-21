<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Appointment | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #1e355d;
        }
        .navbar-brand, .nav-link, .btn-outline-light {
            color: white !important;
        }
        .hero {
            background-color: #2b4c7e;
            color: white;
            padding: 100px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }
        .hero .btn {
            margin-top: 25px;
            padding: 12px 25px;
            font-size: 1.1rem;
            background-color: #4fc3f7;
            border: none;
            color: white;
            border-radius: 30px;
        }
        .illustration {
            max-width: 500px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">🩺 Ready Book</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Feature</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Service</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
            <a href="/login" class="btn btn-outline-light rounded-pill px-4">Login/Register</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Choose Service | For Your Appointment</h1>
        <p>Congrats!! You have come to the right place to get better service. Our experienced staff will take care of your service. Let’s make your appointment.</p>
        <a href="/login" class="btn">Click to Book Appointment</a>
        <div>
            <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-doctor-appointment-3672884-3064041.png" class="illustration img-fluid" alt="Illustration">
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
