@extends('layouts.appclient')

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
                <input type="text" class="form-control" name="name" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="Number" required />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" required />
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
