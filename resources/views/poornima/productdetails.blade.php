@extends('layouts.appclient')

@section('content')
<br><br><br><br><br><br>
<div class="container my-5" >
  <div class="row g-5 align-items-center">
    <div class="col-md-6 text-center">
      <img src="{{asset('storage/'.$productimage->image)}}" alt="{{$product->name}}" class="img-fluid rounded shadow-sm" style="width: 450px; height: 450px; object-fit: cover;">
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
            <input type="radio" id="sizeS" name="sizeRadio" value="small" data-price="{{ $product->small }}" checked>
            <label for="sizeS">S</label>

            <input type="radio" id="sizeM" name="sizeRadio" value="medium" data-price="{{ $product->medium }}">
            <label for="sizeM">M</label>

            <input type="radio" id="sizeL" name="sizeRadio" value="large" data-price="{{ $product->large }}">
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
