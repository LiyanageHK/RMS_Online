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
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8ed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 420px;
            width: 100%;
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
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 2rem;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
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
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            color: var(--primary-color);
        }
        
        .input-group .form-control:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        
        .input-group .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
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
        }
        
        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: var(--secondary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            height: 45px;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--secondary-color);
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 0.5rem;
        }
        
        .forgot-password a {
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: var(--primary-color);
        }
        
        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            color: var(--primary-color);
        }
        
        .is-invalid {
            border-color: var(--primary-color);
        }
        
        .is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--secondary-color);
            font-size: 0.875rem;
        }
        
        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .login-footer a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive adjustments */
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