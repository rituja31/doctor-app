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

        .invalid-feedback {
            color: #e3342f;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .is-invalid {
            border-color: #e3342f;
        }

        .is-invalid ~ .invalid-feedback {
            display: block;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="edit-form-container">
        <div class="form-header">
            <h2>Edit Doctor Profile</h2>
            <span class="status-badge">{{ old('status', $doctor->status) }}</span>
        </div>
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="first_name" value="{{ old('first_name', $doctor->first_name) }}" required
                           class="@error('first_name') is-invalid @enderror">
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="last_name" value="{{ old('last_name', $doctor->last_name) }}" required
                           class="@error('last_name') is-invalid @enderror">
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $doctor->email) }}" required
                           class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" required
                           class="@error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required class="@error('category_id') is-invalid @enderror">
                        <option value="" disabled>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $doctor->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="service_id">Service</label>
                    <select id="service_id" name="service_id" required class="@error('service_id') is-invalid @enderror">
                        <option value="" disabled>Select Service</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id', $doctor->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} ({{ $service->category->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="@error('status') is-invalid @enderror">
                        <option value="Active" {{ old('status', $doctor->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="On Leave" {{ old('status', $doctor->status) == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                        <option value="Retired" {{ old('status', $doctor->status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Doctor</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>