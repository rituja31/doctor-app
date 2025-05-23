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
            background-color: rgb(3, 38, 72);
            padding: 10px 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            z-index: 1000;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
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
        }

        .username {
            font-weight: bold;
            color: rgb(248, 249, 251);
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

        .logout-section {
            margin-top: 30px;
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
        @endauth
    </div>

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Avoid Hassles & Delays.</h1>
            <p>How is health today, Sounds like not good!</p>
            <p>Don't worry. Find your doctor online. Book as you wish with Health Care.<br>
               We offer you a free doctor channeling service. Make your appointment now.</p>
            <a href="#" class="btn-primary">Make Appointment</a>

            @auth
            <div class="logout-section">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </div>

</body>
</html>
