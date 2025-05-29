<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Doctor Profile</title>
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

        .edit-form-container {
            background: white;
            max-width: 900px;
            margin: auto;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-header h2 {
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-actions {
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
    <div class="edit-form-container">
        <div class="form-header">
            <h2>Dr. Nehal Dessai Cardiojogit</h2>
            <span class="status-badge">Active</span>
        </div>

        <form class="form-grid">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" value="Nehal">
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" value="Dessai Cardiojogit">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="nd@gmail.com">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" value="+1 (553) 123-4567">
            </div>

            <div class="form-group">
                <label for="specialty1">Primary Specialty</label>
                <select id="specialty1">
                    <option value="cardiology" selected>Cardiology</option>
                    <option value="neurology">Neurology</option>
                    <option value="orthopedics">Orthopedics</option>
                    <option value="pediatrics">Pediatrics</option>
                    <option value="surgery">Surgery</option>
                </select>
            </div>

            <div class="form-group">
                <label for="specialty2">Secondary Specialty</label>
                <select id="specialty2">
                    <option value="internal-medicine" selected>Internal Medicine</option>
                    <option value="sports-medicine">Sports Medicine</option>
                    <option value="pediatrics">Pediatrics</option>
                </select>
            </div>
        </form>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" onclick="window.location.href='{{ route('admin.dashboard') }}'" class="btn btn-sm btn-edit action-btn">Cancel</button>
        </div>
    </div>
</body>
</html>
