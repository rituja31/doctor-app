<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #e6f0fd;
            --secondary: #3f37c9;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --border-radius: 12px;
            --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7ff;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .medical-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }

        .medical-header {
            padding: 1.5rem 2rem;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .medical-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .medical-header h2 i {
            color: white;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-button:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .timeline {
            padding: 2rem;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 30px;
            width: 2px;
            background: var(--gray-light);
        }

        .record {
            position: relative;
            padding-left: 60px;
            margin-bottom: 2rem;
        }

        .record:last-child {
            margin-bottom: 0;
        }

        .record-icon {
            position: absolute;
            left: 20px;
            top: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .record-content {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: var(--transition);
        }

        .record-content:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .record-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark);
        }

        .record-date {
            font-size: 0.85rem;
            color: var(--gray);
            background: var(--gray-light);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        .record-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.8rem;
            color: var(--gray);
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 0.95rem;
            color: var(--dark);
            font-weight: 500;
        }

        .prescription {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--gray-light);
        }

        .prescription-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .prescription-item i {
            color: var(--success);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray);
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--gray-light);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        .record-type {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .record-details {
                grid-template-columns: 1fr;
            }
            
            .record-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .timeline::before {
                left: 20px;
            }
            
            .record {
                padding-left: 50px;
            }
            
            .record-icon {
                left: 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="medical-card">
        <div class="medical-header">
            <h2><i class="fas fa-file-medical"></i> My Medical History</h2>
            <a href="{{ route('patient.dashboard') }}" class="back-button">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        
        <div class="timeline">
            <!-- Consultation Record -->
            <div class="record">
                <div class="record-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="record-content">
                    <span class="record-type">CONSULTATION</span>
                    <div class="record-header">
                        <h3 class="record-title">Dr. Sarah Smith - Neurology</h3>
                        <span class="record-date">April 12, 2025</span>
                    </div>
                    <div class="record-details">
                        <div class="detail-item">
                            <span class="detail-label">Diagnosis</span>
                            <span class="detail-value">Migraine with aura</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Duration</span>
                            <span class="detail-value">30 minutes</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value" style="color: var(--success);">Completed</span>
                        </div>
                    </div>
                    <div class="prescription">
                        <h4>Prescription</h4>
                        <div class="prescription-item">
                            <i class="fas fa-pills"></i>
                            <span>Sumatriptan 50mg - Take 1 tablet at onset</span>
                        </div>
                        <div class="prescription-item">
                            <i class="fas fa-pills"></i>
                            <span>Ibuprofen 400mg - Every 6 hours as needed</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Checkup Record -->
            <div class="record">
                <div class="record-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="record-content">
                    <span class="record-type">CHECKUP</span>
                    <div class="record-header">
                        <h3 class="record-title">Annual Physical Examination</h3>
                        <span class="record-date">March 28, 2025</span>
                    </div>
                    <div class="record-details">
                        <div class="detail-item">
                            <span class="detail-label">Diagnosis</span>
                            <span class="detail-value">Healthy</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Blood Pressure</span>
                            <span class="detail-value">120/80 mmHg</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">BMI</span>
                            <span class="detail-value">22.4 (Normal)</span>
                        </div>
                    </div>
                    <div class="prescription">
                        <h4>Recommendations</h4>
                        <div class="prescription-item">
                            <i class="fas fa-dumbbell"></i>
                            <span>30 minutes of daily exercise</span>
                        </div>
                        <div class="prescription-item">
                            <i class="fas fa-apple-alt"></i>
                            <span>Increase fruit and vegetable intake</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lab Test Record -->
            <div class="record">
                <div class="record-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="record-content">
                    <span class="record-type">LAB TEST</span>
                    <div class="record-header">
                        <h3 class="record-title">Comprehensive Blood Panel</h3>
                        <span class="record-date">February 15, 2025</span>
                    </div>
                    <div class="record-details">
                        <div class="detail-item">
                            <span class="detail-label">Test Type</span>
                            <span class="detail-value">CBC, Lipid Panel, Metabolic</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value" style="color: var(--success);">Normal</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Lab</span>
                            <span class="detail-value">City Medical Labs</span>
                        </div>
                    </div>
                    <div class="prescription">
                        <h4>Notable Results</h4>
                        <div class="prescription-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Cholesterol: 180 mg/dL (Normal)</span>
                        </div>
                        <div class="prescription-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Glucose: 92 mg/dL (Normal)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>