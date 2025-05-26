<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('/images/bg4.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .roles {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .roles label {
            display: flex;
            align-items: center;
        }

        .roles input {
            margin-right: 6px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }

        .signup-link {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Welcome Back!</h2>
        <p>Login with your details to continue</p>

        @if(session('success'))
            <div style="color: green; text-align: center;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div style="color: red; text-align: center;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="roles">
                <label><input type="radio" name="role" value="admin" required> Admin</label>
                <label><input type="radio" name="role" value="doctor"> Doctor</label>
                <label><input type="radio" name="role" value="patient"> Patient</label>

            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button class="login-btn" type="submit">Login</button>

            <div class="signup-link">
                Don’t have an account? <a href="{{ route('register') }}">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>