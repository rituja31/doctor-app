<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h2>Login</h2>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>

    <label for="role">Login as:</label>
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="doctor">Doctor</option>
        <option value="patient">Patient</option>
    </select><br><br>

    <button type="submit">Login</button>
</form> 
</body>
</html>