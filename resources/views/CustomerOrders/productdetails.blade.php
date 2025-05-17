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

<br><br><br><br><br><br>
<div class="container my-5" >
  <div class="row g-5 align-items-center">
    <div class="col-md-6 text-center">
      <img src="{{asset(uploads/products/.$productimage->image)}}" alt="{{$product->name}}" class="img-fluid rounded shadow-sm" style="width: 450px; height: 450px; object-fit: cover;">
    </div>

    <div class="col-md-6">
      <h2 class="fw-bold">{{$product->name}}</h2>
      <div class="rating mb-2">
        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
        <i class="bi bi-star-half"></i>
        <span class="text-muted ms-2">(4.5/5)</span>
      </div>
      <p class="text-secondary">{{$product->description}}</p>

      <form action="{{ route('add.to.cart') }}" method="POST" id="cartForm">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" id="quantityInput" value="1">
        <input type="hidden" name="size" id="sizeInput" value="small">
        <input type="hidden" name="extra_toppings" id="toppingsInput" value="0">

        <!-- Size Options -->
        <div class="mb-3">
          <strong>Size:</strong>
          <div class="size-btn mt-2">
            <input type="radio" id="sizeS" name="sizeRadio" value="small" data-price="{{ $product->small_price }}" checked>
            <label for="sizeS">S</label>

            <input type="radio" id="sizeM" name="sizeRadio" value="medium" data-price="{{ $product->medium_price }}">
            <label for="sizeM">M</label>

            <input type="radio" id="sizeL" name="sizeRadio" value="large" data-price="{{ $product->large_price }}">
            <label for="sizeL">L</label>
          </div>
        </div>

        <!-- Quantity Selector -->
        <div class="mb-3">
          <strong>Quantity:</strong>
          <div class="input-group w-50">
            <button class="btn btn-outline-secondary" type="button" onclick="adjustQty(-1)">-</button>
            <input type="text" id="qtyInput" class="form-control text-center" value="1" readonly>
            <button class="btn btn-outline-secondary" type="button" onclick="adjustQty(1)">+</button>
          </div>
        </div>

        <!-- Extra Toppings -->
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="toppingsCheck">
          <label class="form-check-label" for="toppingsCheck">
            Extra Toppings (+ LKR 150.00)
          </label>
        </div>

        <!-- Price -->
        <h4 class="fw-semibold text-success mb-3">LKR <span id="priceDisplay">0.00</span></h4>

        <!-- Buttons -->
        <div class="d-flex flex-wrap gap-2">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-cart-check"></i> Add to Cart
          </button>
          <a href="{{ route('cartview') }}" class="btn btn-outline-secondary px-4">
            <i class="bi bi-box-arrow-right"></i> Go to Cart
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<br><br>
<!-- Styling -->

<style>
  .rating i { color: #ffc107; }
  .size-btn input[type="radio"] { display: none; }
  .size-btn label {
    cursor: pointer;
    border: 2px solid #dee2e6;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    margin-right: 0.5rem;
    transition: all 0.3s ease;
  }
  .size-btn input[type="radio"]:checked + label {
    background-color: #198754;
    color: white;
    border-color: #198754;
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- JavaScript -->
@if (session('success'))
<script>
  alert("{{ session('success') }}");
</script>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('qtyInput');
    const toppingsCheck = document.getElementById('toppingsCheck');
    const priceDisplay = document.getElementById('priceDisplay');
    const sizeRadios = document.querySelectorAll('input[name="sizeRadio"]');

    const hiddenSize = document.getElementById('sizeInput');
    const hiddenQty = document.getElementById('quantityInput');
    const hiddenToppings = document.getElementById('toppingsInput');

    function updatePrice() {
      const qty = parseInt(qtyInput.value);
      let sizePrice = 0;
      let sizeValue = 'small';

      sizeRadios.forEach((radio) => {
        if (radio.checked) {
          sizePrice = parseFloat(radio.dataset.price);
          sizeValue = radio.value;
        }
      });

      const extra = toppingsCheck.checked ? 150 : 0;
      const total = (sizePrice + extra) * qty;

      priceDisplay.textContent = total.toFixed(2);
      hiddenSize.value = sizeValue;
      hiddenQty.value = qty;
      hiddenToppings.value = toppingsCheck.checked ? 1 : 0;
    }

    window.adjustQty = function (change) {
      let qty = parseInt(qtyInput.value);
      qty = Math.max(1, qty + change);
      qtyInput.value = qty;
      updatePrice();
    }

    toppingsCheck.addEventListener('change', updatePrice);
    sizeRadios.forEach(radio => radio.addEventListener('change', updatePrice));

    updatePrice(); // Initialize price
  });
</script>

@endsection
