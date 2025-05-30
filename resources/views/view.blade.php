<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctor Profile</title>
    <style>
        :root {
            --primary-color: #4a6cf7;
            --border-color: #e2e8f0;
            --text-color: #2d3748;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-color);
            line-height: 1.6;
            padding: 40px;
        }

        .view-container {
            background: white;
            max-width: 900px;
            margin: auto;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .view-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .view-header h2 {
            color: var(--text-color);
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: #ebf8f2;
            color: #38a169;
        }

        .view-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .view-group {
            margin-bottom: 20px;
        }

        .view-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }

        .view-group span {
            display: block;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            background-color: #f9fafb;
        }

        .view-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
        }

        .btn-secondary {
            background-color: white;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: #f5f7fa;
        }
    </style>
</head>
<body>
    <div class="view-container">
        <div class="view-header">
            <h2>Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h2>
            <span class="status-badge">{{ $doctor->status }}</span>
        </div>

        <div class="view-grid">
            <div class="view-group">
                <label>First Name</label>
                <span>{{ $doctor->first_name }}</span>
            </div>

            <div class="view-group">
                <label>Last Name</label>
                <span>{{ $doctor->last_name }}</span>
            </div>

            <div class="view-group">
                <label>Email</label>
                <span>{{ $doctor->email }}</span>
            </div>

            <div class="view-group">
                <label>Phone</label>
                <span>{{ $doctor->phone }}</span>
            </div>

            <div class="view-group">
                <label>Specialties</label>
                <span>{{ $doctor->specialties }}</span>
            </div>

            <div class="view-group">
                <label>Status</label>
                <span>{{ $doctor->status }}</span>
            </div>
        </div>

        <div class="view-actions">
            <a href="{{ route('edit.page', $doctor->id) }}" class="btn btn-primary">Edit Doctor</a>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>