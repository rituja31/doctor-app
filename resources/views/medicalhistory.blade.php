<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #003366;
            margin-bottom: 20px;
        }

        .record {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }

        .record:last-child {
            border-bottom: none;
        }

        .record h4 {
            margin: 0 0 5px;
            color: #005b96;
        }

        .record p {
            margin: 0;
            font-size: 0.95rem;
            color: #333;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-button:hover {
            background-color: #1792d3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>My Medical History</h2>

    {{-- Example records. Replace with actual dynamic data if needed --}}
    <div class="record">
        <h4>Consultation with Dr. Smith</h4>
        <p><strong>Date:</strong> 2025-04-12</p>
        <p><strong>Diagnosis:</strong> Migraine</p>
        <p><strong>Prescription:</strong> Pain relievers, rest</p>
    </div>

    <div class="record">
        <h4>General Checkup</h4>
        <p><strong>Date:</strong> 2025-03-28</p>
        <p><strong>Diagnosis:</strong> Healthy</p>
        <p><strong>Notes:</strong> Recommended daily exercise</p>
    </div>

    <div class="record">
        <h4>Blood Test</h4>
        <p><strong>Date:</strong> 2025-02-15</p>
        <p><strong>Results:</strong> All parameters normal</p>
    </div>

    <a href="{{ route('patient.dashboard') }}" class="back-button">← Back to Dashboard</a>
</div>

</body>
</html>
