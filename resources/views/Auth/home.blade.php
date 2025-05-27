<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MediCare - Doctor Appointment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book doctor appointments online with MediCare. Fast, secure, and convenient healthcare services.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #3b82f6;
            --accent-color: #00c4ff;
            --dark-color: #1f3557;
            --light-color: #f8fafc;
            --text-color: #334155;
            --text-light: #64748b;
            --white: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: var(--white);
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            text-decoration: none;
        }

        .logo i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .navbar .nav-links {
            display: flex;
            gap: 30px;
        }

        .navbar a {
            color: var(--dark-color);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .navbar a:hover {
            color: var(--primary-color);
        }

        .navbar a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            bottom: -5px;
            left: 0;
            transition: var(--transition);
        }

        .navbar a:hover:after {
            width: 100%;
        }

        .login-register-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .login-register-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 100vh;
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0 10%;
            position: relative;
        }

        .hero-content {
            max-width: 600px;
            z-index: 2;
            animation: fadeIn 1s ease-in-out;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary i {
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
            margin-left: 15px;
        }

        .btn-outline:hover {
            background-color: var(--white);
            color: var(--primary-color);
        }

        .features-section {
            padding: 100px 10%;
            background-color: var(--white);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.2rem;
            color: var(--dark-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title p {
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--white);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .feature-card p {
            color: var(--text-light);
        }

        .about-section {
            padding: 100px 10%;
            background-color: var(--light-color);
            display: flex;
            align-items: center;
            gap: 50px;
        }

        .about-image {
            flex: 1;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .about-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        .about-content {
            flex: 1;
        }

        .about-content h2 {
            font-size: 2.2rem;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .about-content p {
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item h3 {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-item p {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .contact-section {
            padding: 100px 10%;
            background-color: var(--white);
        }

        .contact-card {
            max-width: 800px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .contact-info p {
            color: var(--text-light);
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .contact-icon {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-top: 3px;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            transition: var(--transition);
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .form-row > div {
            flex: 1;
        }

        footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 50px 10% 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h3:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
            bottom: 0;
            left: 0;
        }

        .footer-column p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 15px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            color: var(--white);
            background: rgba(255, 255, 255, 0.1);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .dashboard-links {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 5%;
            }
            
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .about-section {
                flex-direction: column;
            }
            
            .contact-card {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="#home" class="logo">
        <i class="fas fa-heartbeat"></i>
        <span>MediCare</span>
    </a>
    <div class="nav-links">
        <a href="#home">Home</a>
        <a href="#features">Features</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
    </div>
    <div>
        <a href="{{ route('login') }}" class="login-register-btn">
            <i class="fas fa-user"></i> Login/Register
        </a>
    </div>
</div>

<div class="hero-section" id="home">
    <div class="hero-content">
        <h1>Quality Healthcare Made Simple</h1>
        <p>Book appointments with top specialists in your area. Our platform connects you with healthcare providers quickly and securely, saving you time and hassle.</p>
        
        <div>
            <a href="{{ route('appointment.page') }}" class="btn-primary">
                <i class="fas fa-calendar-check"></i> Book Appointment
            </a>
            <a href="#features" class="btn-primary btn-outline">Learn More</a>
        </div>

        @auth
            <div class="dashboard-links">
                @if(Auth::user()->role === 'doctor')
                    <a href="{{ route('doctor.dashboard') }}" class="btn-primary">
                        <i class="fas fa-user-md"></i> Doctor Dashboard
                    </a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                        <i class="fas fa-cog"></i> Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('patient.dashboard') }}" class="btn-primary">
                        <i class="fas fa-user-injured"></i> Patient Dashboard
                    </a>
                @endif
            </div>
        @endauth
    </div>
</div>

<!-- Features Section -->
<div id="features" class="features-section">
    <div class="section-title">
        <h2>Why Choose MediCare</h2>
        <p>We provide the best healthcare services with modern technology and professional doctors</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3>24/7 Availability</h3>
            <p>Book appointments anytime, anywhere with our 24/7 online platform.</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <h3>Expert Doctors</h3>
            <p>Access to qualified and experienced healthcare professionals.</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Secure Platform</h3>
            <p>Your data is protected with industry-standard security measures.</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3>Easy Scheduling</h3>
            <p>Simple and intuitive interface for managing your appointments.</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-bell"></i>
            </div>
            <h3>Reminders</h3>
            <p>Get timely reminders for your upcoming appointments.</p>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-file-medical"></i>
            </div>
            <h3>Medical Records</h3>
            <p>Secure access to your medical history and prescriptions.</p>
        </div>
    </div>
</div>

<!-- About Section -->
<div id="about" class="about-section">
    <div class="about-image">
        <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Doctor and patient">
    </div>
    
    <div class="about-content">
        <h2>About Our Healthcare Platform</h2>
        <p>MediCare is a leading healthcare provider dedicated to making medical services accessible to everyone. Our mission is to bridge the gap between patients and healthcare professionals through innovative technology.</p>
        <p>With years of experience in the medical field, we understand the importance of timely and quality healthcare. Our platform is designed to simplify the appointment process while maintaining the highest standards of care.</p>
        
        <div class="stats">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Specialists</p>
            </div>
            <div class="stat-item">
                <h3>50K+</h3>
                <p>Patients</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Support</p>
            </div>
        </div>
    </div>
</div>

<div id="contact" class="contact-section">
    <div class="section-title">
        <h2>Get In Touch</h2>
        <p>Have questions or need assistance? Our team is here to help you</p>
    </div>
    
    <div class="contact-card">
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p>Fill out the form or contact us directly using the information below.</p>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <h4>Location</h4>
                    <p>123 Medical Drive, Margao Goa</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <h4>Phone</h4>
                    <p>+91 7666373347</p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <h4>Email</h4>
                    <p>info@medicare.com</p>
                </div>
            </div>
            
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        
        <form class="contact-form">
            <div class="form-row">
                <div>
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" placeholder="Enter your full name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email" required>
                </div>
            </div>
            
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" placeholder="Enter your phone number">
            
            <label for="subject">Subject</label>
            <input type="text" id="subject" placeholder="Enter subject">
            
            <label for="message">Message</label>
            <textarea id="message" placeholder="Write your message here..." required></textarea>
            
            <button type="submit" class="btn-primary">
                <i class="fas fa-paper-plane"></i> Send Message
            </button>
        </form>
    </div>
</div>

<footer>
    <div class="footer-content">
        <div class="footer-column">
            <h3>MediCare</h3>
            <p>Your trusted partner in healthcare. We provide innovative solutions to connect patients with healthcare providers seamlessly.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul class="footer-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
        
        <div class="footer-column">
            <h3>Services</h3>
            <ul class="footer-links">
                <li><a href="#">Doctor Appointments</a></li>
                <li><a href="#">Medical Records</a></li>
                <li><a href="#">Health Tips</a></li>
                <li><a href="#">Emergency Services</a></li>
                <li><a href="#">Telemedicine</a></li>
            </ul>
        </div>
        
        <div class="footer-column">
            <h3>Newsletter</h3>
            <p>Subscribe to our newsletter for the latest updates and health tips.</p>
            <form>
                <input type="email" placeholder="Your email address" style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: none;">
                <button type="submit" class="btn-primary" style="width: 100%;">Subscribe</button>
            </form>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2025 MediCare. All Rights Reserved. | <a href="#" style="color: var(--accent-color);">Privacy Policy</a> | <a href="#" style="color: var(--accent-color);">Terms of Service</a></p>
    </div>
</footer>

</body>
</html>