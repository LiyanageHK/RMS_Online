@extends('layouts.appclient')

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
        <a href="" class="btn btn-success btn-custom">Done</a>
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
