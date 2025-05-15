@extends('layouts.appclient')

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
            <img src="{{ asset('storage/' . $item->product->image->image) }}" class="product-img me-3" alt="Pizza">
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
