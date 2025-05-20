<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    
    <style>
        :root {
            --primary-color: #E7592B;
            --primary-hover: #d14c22;
            --secondary-color: #6c757d;
            --light-gray: #f8f9fa;
            --border-radius: 0.375rem;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 0;
            margin: 0;
            font-family: 'Source Sans Pro', sans-serif;
        }
        
        .split-layout {
            display: flex;
            width: 100%;
            min-height: 100vh;
            flex-direction: row-reverse; /* This flips the layout */
        }
        
        .image-section {
            flex: 1;
            background: url('{{ asset('images/login_bg.jpeg') }}') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .image-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }
        
        .image-content {
            position: relative;
            z-index: 1;
            color: white;
            padding: 2rem;
            max-width: 600px;
        }
        
        .image-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .image-content p {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .form-section {
            width: 450px;
            background: white;
            display: flex;
            align-items: center;
            padding: 2rem;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        .login-logo {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .login-logo a {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .login-logo a i {
            font-size: 2.5rem;
        }
        
        .login-card {
            background: #fff;
            border-radius: var(--border-radius);
            padding: 2rem;
            border: none;
        }
        
        .login-card-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .login-card-header h3 {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .login-card-header p {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-control {
            height: 45px;
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(231, 89, 43, 0.25);
        }
        
        .btn-login {
            background: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            height: 45px;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white;
        }
        
        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--secondary-color);
            font-size: 0.875rem;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .split-layout {
                flex-direction: column;
            }
            
            .image-section {
                display: none;
            }
            
            .form-section {
                width: 100%;
                min-height: 100vh;
            }
        }
        
        @media (max-width: 576px) {
            .login-container {
                padding: 0 15px;
            }
            
            .login-card {
                padding: 1.5rem;
            }
        }
    </style>
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition login-page">
    <div class="split-layout">
        <!-- Image Section (now on the right) -->
        <div class="image-section">
            <div class="image-content">
                <h2>Welcome to Flame & Crust</h2>
                <p>Discover our delicious menu crafted with the finest ingredients and traditional recipes passed down through generations.</p>
            </div>
        </div>
        
        <!-- Form Section (now on the left) -->
        <div class="form-section">
            <div class="login-container">
                <div class="login-logo">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-pizza-slice"></i>
                        <span>Flame & Crust</span>
                    </a>
                </div>
                <div class="login-card">
                    <div class="login-card-header">
                        <h3>Sign In</h3>
                        <p>Enter your credentials to access your account</p>
                    </div>
                    @yield('content')
                </div>
                <div class="login-footer">
                    <!-- Footer content here -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>