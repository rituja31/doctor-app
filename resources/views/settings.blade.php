<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #003366;
            margin-bottom: 25px;
        }

        .profile-box {
            background-color: #eaf2fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 5px solid #003366;
        }

        .profile-box p {
            margin: 5px 0;
            color: #333;
        }

        form label {
            display: block;
            margin-top: 15px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        button {
            background-color: #003366;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #1792d3;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #003366;
        }

        .back-link:hover {
            color: #1792d3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Account Settings</h2>

    {{-- Profile Summary --}}
    <div class="profile-box">
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Role:</strong> {{ Auth::user()->role ?? 'Patient' }}</p>
        {{-- Add more fields like phone, age, etc., if available --}}
    </div>

    {{-- Settings Form --}}
    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="notifications">Notification Preferences</label>
            <input type="text" id="notifications" name="notifications" placeholder="e.g., Email, SMS">
        </div>

        <button type="submit">Update Settings</button>
    </form>

    <a href="{{ route('patient.dashboard') }}" class="back-link">← Back to Dashboard</a>
</div>

</body>
</html>
