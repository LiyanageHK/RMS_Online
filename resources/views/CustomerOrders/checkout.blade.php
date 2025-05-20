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
  <title>Order Confirmation - Flame & Crust</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f8f9fa;
    }

    .order-container {
      max-width: 1100px;
      margin: auto;
      background: #fff;
      border-radius: 20px;
      padding: 0; 
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .photo-section {
      height: 100px;
      background-image: url('{{ asset('uploads/poornima/checkout.jpeg') }}');
      background-size: cover;
      background-position: center;
      border-radius: 20px 20px 0 0;
    }

    .inner-content {
      padding: 30px;
    }

    .bill-box {
      border: 2px solid #dee2e6;
      padding: 20px;
      border-radius: 10px;
    }

    .bill-title {
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-dark {
      border-radius: 10px;
    }

    .radio-group {
      gap: 1rem;
    }
  </style>
</head>
<body>

  <div class="container my-5 order-container">
    <!-- Banner Image -->
    <div class="photo-section"></div>

    <!-- Main Content -->
    <div class="inner-content">
      <h3 class="mb-4 text-center">🧾 Order Confirmation</h3>

      <div class="row g-5">
        <!-- Bill Section -->
        <div class="col-md-4">
          <div class="bill-box">
            <div class="bill-title">Bill Summary</div>
            <div class="d-flex justify-content-between mb-2">
              <span>Sub Total</span><strong>LKR {{ number_format($subTotal, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Discount</span><strong class="text-success">LKR {{ number_format($discount, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Delivery</span><strong>LKR {{ number_format($delivery, 2) }}</strong>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
              <strong>Total</strong><strong class="text-dark">LKR {{ number_format($total, 2) }}</strong>
            </div>
          </div>
        </div>

        <!-- Form Section -->
        <div class="col-md-8">
          <form action="{{ route('confirm.order') }}" method="POST">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}"  required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="Number" value="{{$user->phone}}" required />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" value="{{$user->address}}" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Landmarks</label>
              <input type="text" class="form-control" name="marks" />
            </div>

            <div class="mb-4">
              <label class="form-label d-block">Payment Method</label>
              <div class="d-flex radio-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" value="online" id="pay_online" />
                  <label class="form-check-label" for="pay_online">Pay Online</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked />
                  <label class="form-check-label" for="cod">Cash on Delivery</label>
                </div>
              </div>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg">Confirm Order</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @if (session('success'))
    <script>
      alert("{{ session('success') }}");
    </script>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
