<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-profile {
            width: 230px;
        }
        .admin-profile img {
            width: 60px;
            height: 60px;
        }

        .top-right-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            z-index: 1000;
        }
    </style>
</head>
<body>


<div class="position-absolute top-0 start-0 m-3">
    <div class="card shadow-sm admin-profile">
        <div class="card-body text-center">
            <div class="mb-2">
                <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle bg-light p-2" width="60" height="60" alt="Admin Image">
            </div>
            <h6 class="mb-0">Admin</h6>
            <small class="text-muted">{{ session('admin_email', 'admin@gmail.com') }}</small>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-light border w-100" style="background-color: #e6f0ff;">Log out</button>
            </form>
        </div>
    </div>
</div>


<div class="container mt-5 pt-3" style="margin-left: 260px;">
    <h1 class="mb-4">Add New Doctor</h1>

    <div class="d-flex justify-content-between mb-3">
        <h5>All Doctors (1)</h5>
        <button class="btn btn-primary">+ Add New</button>
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
            <tr>
                <th>Doctor Name</th>
                <th>Email</th>
                <th>Specialties</th>
                <th>Events</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nehal Dessai</td>
                <td>nd@gmail.com</td>
                <td>Accident and emergency</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                    <button class="btn btn-sm btn-outline-info">View</button>
                    <button class="btn btn-sm btn-outline-danger">Remove</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
