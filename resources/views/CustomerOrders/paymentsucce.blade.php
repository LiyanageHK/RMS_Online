@extends('layouts.appclient')
<style>
         :root {
            --primary-red: #E7592B;
            --dark-red: #E7592B;
            --light-red: #ff6b6b;
            --dark-bg: #1a1a1a;
            --light-bg: #f9f9f9;
            --text-dark: #333;
            --text-light: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--light-bg);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 0 60px;
        }

        /* Header Styles */
        header {
            background-color: var(--text-light);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            font-size: 28px;
            color: var(--primary-red);
            margin-left: 10px;
        }

        .logo span {
            display: block;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            letter-spacing: 2px;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: var(--primary-red);
        }

        


        /* Footer */
        footer {
            background-color: var(--dark-bg);
            color: var(--text-light);
            padding: 60px 0 20px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            margin-bottom: 20px;
        }

        .footer-logo h2 {
            font-size: 28px;
            color: var(--text-light);
            margin-bottom: 5px;
        }

        .footer-logo span {
            display: block;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .footer-about p {
            margin-bottom: 20px;
        }

        .footer-links h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--text-light);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 10px;
        }

        .footer-links ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links ul li a:hover {
            color: var(--light-red);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #999;
            font-size: 14px;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--primary-red);
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {
            .menu-grid {
                grid-template-columns: repeat(2, minmax(300px, 380px));
            }
        }

        @media (max-width: 768px) {
            .header-container {
                padding: 15px;
            }

            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background-color: var(--text-light);
                transition: left 0.3s;
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
                padding: 20px;
            }

            nav ul li {
                margin: 15px 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .page-banner h1 {
                font-size: 36px;
            }

            .container {
                padding: 0 30px;
            }

            .menu {
                padding: 60px 0;
            }

            .menu-grid {
                grid-template-columns: minmax(280px, 380px);
            }

            .menu-item {
                flex-direction: column;
            }

            .menu-item-img {
                height: 200px;
            }

            .menu-item-info {
                padding: 20px;
            }

            .menu-item-info h3 {
                font-size: 22px;
            }

            .pizza-sizes {
                gap: 10px;
            }
        }
    
    </style>
@section('content')
<br><br><br>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Successful</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f4f7fc;
      font-family: 'Segoe UI', sans-serif;
    }

    .photo-section {
      
      background-size: cover;
      background-position: center;
      height: 200px;
      border-radius: 20px 20px 0 0;
    }

    .payment-container {
      max-width: 500px;
      margin: 60px auto;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .payment-box {
      background-color: white;
      padding: 40px 30px;
      text-align: center;
    }

    .success-icon {
      font-size: 60px;
      color: #28a745;
    }

    .btn-custom {
      padding: 10px 30px;
      font-size: 16px;
      border-radius: 30px;
    }

    .footer-note {
      font-size: 14px;
      color: #6c757d;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="payment-container">
    <div class="photo-section" style="background-image: url('{{ asset('uploads/poornima/psuc image.jpeg') }}');"></div>

    <div class="payment-box">
      <p class="text-success fs-5 fw-semibold">Your order has been successfully placed!</p>
      <div class="success-icon"><i class="fas fa-check-circle" style="color: #28a745; font-size: 70px;"></i></div>
      <p class="mt-3">Thank you for your payment.</p>

      <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ route('menu') }}" class="btn btn-success btn-custom">Done</a>
        <a href="{{ route('user.orders') }}" class="btn btn-outline-primary btn-custom">My Orders</a>
      </div>

      <div class="footer-note">
        You can view your order status or return to the homepage.
      </div>
    </div>
  </div>

  
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>

@endsection
