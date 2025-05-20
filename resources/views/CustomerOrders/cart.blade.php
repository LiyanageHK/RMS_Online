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
<br><br><br><br>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Cart - Flame & Crust</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f9f9f9;
    }

    .cart-item {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .cart-summary {
      background: #fff;
      padding: 0;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .summary-banner {
      background-image: url('{{ asset('uploads/poornima/cartimage.jpg') }}'); 
      background-size: cover;
      background-position: center;
      height: 160px;
    }

    .summary-content {
      padding: 25px;
    }

    .product-img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
    }
  </style>
  
</head>
<body>

<div class="container py-5">
  
  <h2 class="mb-4 text-center fw-bold">🛒 Your Cart</h2>
  <div class="row">
    <!-- Cart Items -->
    <div class="col-md-8">
      <div id="cartItems">
        @foreach ($cartItems as $item)
        <div class="cart-item d-flex align-items-center justify-content-between" data-id="{{ $item->id }}">
          <div class="d-flex align-items-center">
            <img src="{{ asset('uploads/products/' . $item->product->image->image) }}" class="product-img me-3" alt="Pizza">
            <div>
              <h5 class="mb-1">{{ $item->product->name }} <span class="badge bg-secondary">{{ ucfirst($item->size) }}</span></h5>
              <p class="mb-0 text-muted">LKR <span class="item-price">{{ number_format($item->price, 2) }}</span></p>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div class="input-group input-group-sm me-3">
              <button class="btn btn-outline-secondary btn-decrease">−</button>
              <input type="text" class="form-control text-center item-qty" value="{{ $item->quantity }}" style="width: 50px;">
              <button class="btn btn-outline-secondary btn-increase">+</button>
            </div>
            <div class="fw-bold me-3">LKR <span class="item-subtotal">{{ number_format($item->subtotal, 2) }}</span></div>
            <form id="deleteForm-{{ $item->id }}" method="POST" action="{{ route('cart.remove', $item->id) }}">
              @csrf
              @method('DELETE')
              <button type="button" onclick="showDeleteModal({{ $item->id }}, '{{ $item->product->name }}')" class="btn btn-outline-danger btn-delete">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="col-md-4">
      <div class="cart-summary d-flex flex-column" style="height: 460px;">
        <!-- Banner -->
        <div class="summary-banner"></div>

        <!-- Summary Details -->
        <div class="summary-content d-flex flex-column h-100">
          <h4 class="mb-3">Cart Summary</h4>
          <div class="d-flex justify-content-between">
            <span>Sub Total</span>
            <span>LKR <span id="subtotal">{{ number_format($subTotal, 2) }}</span></span>
          </div>
          <div class="d-flex justify-content-between">
            <span>Discount</span>
            <span>LKR <span id="discount">{{ number_format($discount, 2) }}</span></span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Delivery</span>
            <span>LKR <span id="delivery">{{ number_format($delivery, 2) }}</span></span>
          </div>
          <hr>
          <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
            <span>Total</span>
            <span>LKR <span id="total">{{ number_format($total, 2) }}</span></span>
          </div>
          <form method="GET" action="{{ route('checkout') }}" class="mt-auto">
            <button type="submit" class="btn btn-success w-100">Proceed to Checkout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('user.orders') }}" class="btn btn-outline-secondary">
      My Orders  <i class="fas fa-arrow-right me-1"></i>
    </a>
  </div>
</div>
  

<!-- Delete Confirmation Modal -->
<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
  <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
    <div style="margin-bottom: 15px;">
      <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
    </div>
    <h4 class="mb-2">Confirm Deletion</h4>
    <p id="modalMessage">Are you sure you want to delete this item?</p>
    <div class="d-flex justify-content-center gap-3">
      <button id="cancelBtn" class="btn btn-secondary">Cancel</button>
      <button id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
    </div>
  </div>
</div>


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  function sendQuantityUpdate(cartItemId, newQuantity, itemSubtotalElement) {
    fetch("{{ route('cart.updateQuantity') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ id: cartItemId, quantity: newQuantity })
    })
    .then(response => response.json())
    .then(data => {
      itemSubtotalElement.textContent = data.itemSubtotal;
      document.getElementById('subtotal').textContent = data.subTotal;
      document.getElementById('discount').textContent = data.discount;
      document.getElementById('total').textContent = data.total;
    })
    .catch(error => console.error('Quantity update failed:', error));
  }

  document.querySelectorAll('.btn-increase').forEach(button => {
    button.addEventListener('click', function () {
      const cartItem = this.closest('.cart-item');
      const cartItemId = cartItem.dataset.id;
      const input = cartItem.querySelector('.item-qty');
      const itemSubtotal = cartItem.querySelector('.item-subtotal');
      input.value = parseInt(input.value) + 1;
      sendQuantityUpdate(cartItemId, input.value, itemSubtotal);
    });
  });

  document.querySelectorAll('.btn-decrease').forEach(button => {
    button.addEventListener('click', function () {
      const cartItem = this.closest('.cart-item');
      const cartItemId = cartItem.dataset.id;
      const input = cartItem.querySelector('.item-qty');
      const itemSubtotal = cartItem.querySelector('.item-subtotal');
      input.value = Math.max(1, parseInt(input.value) - 1);
      sendQuantityUpdate(cartItemId, input.value, itemSubtotal);
    });
  });

  document.querySelectorAll('.item-qty').forEach(input => {
    input.addEventListener('change', function () {
      const cartItem = this.closest('.cart-item');
      const cartItemId = cartItem.dataset.id;
      const itemSubtotal = cartItem.querySelector('.item-subtotal');
      this.value = Math.max(1, parseInt(this.value));
      sendQuantityUpdate(cartItemId, this.value, itemSubtotal);
    });
  });
});
</script>

<script>
let formToSubmit = null;

function showDeleteModal(id, name) {
  formToSubmit = document.getElementById('deleteForm-' + id);
  document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
  document.getElementById('confirmModal').style.display = 'flex';
}

document.getElementById('cancelBtn').addEventListener('click', function () {
  document.getElementById('confirmModal').style.display = 'none';
  formToSubmit = null;
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
  if (formToSubmit) formToSubmit.submit();
});
</script>

</body>
</html>

@endsection
