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
<div class="container mt-5">
    <h2 class="mb-4">My Orders</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($orders as $order)
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Order #{{ $order->id }}</h5>
                    <p class="card-text mb-1"><strong>Total:</strong> Rs. {{ number_format($order->total, 2) }}</p>
                    <p class="card-text mb-1"><strong>Status:</strong> <span class="badge bg-success">{{ $order->payment_status }}</span></p>
                    <p class="card-text"><strong>Date:</strong> {{ $order->created_at }}</p>
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="offcanvas" data-bs-target="#orderDetails{{ $order->id }}" onclick="loadOrderDetails({{ $order->id }})">
                        View Details
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="orderDetails{{ $order->id }}">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Order #{{ $order->id }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div id="order-items-{{ $order->id }}">
                    Loading...
                </div>

                <h6 class="mt-3">Status: <span class="badge bg-info text-dark" id="status-label-{{ $order->id }}"></span></h6>
                <div class="progress mb-3" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" id="status-bar-{{ $order->id }}" style="width: 0%;">
                    </div>
                </div>


                <form id="cancel-form-{{ $order->id }}" method="POST" action="/cancel-order/{{ $order->id }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" onclick="showDeleteModal()" class="btn btn-danger w-100">
                        Cancel Order
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br><br>
<!-- Delete Confirmation Modal -->
<div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
  <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
    <div style="margin-bottom: 15px;">
      <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
    </div>
    <h4 class="mb-2">order cancellation</h4>
    <p id="modalMessage">Are you sure you want to Cancel this order ?</p>
    <div class="d-flex justify-content-center gap-3">
      <button id="cancelBtn" class="btn btn-secondary">No</button>
      <button id="confirmDeleteBtn" class="btn btn-danger">Yes</button>
    </div>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function loadOrderDetails(orderId) {
        fetch(`/order-details/${orderId}`)
            .then(response => response.json())
            .then(data => {
                let itemsHtml = '';
                data.items.forEach(item => {
                    itemsHtml += `<li class="list-group-item">${item.size} ${item.product_name} ${item.extra_toppings !== 'N/A' ? 'with extra toppings' : ''} × ${item.quantity}</li>`;
                });

                document.getElementById('order-items-' + orderId).innerHTML = `<ul class="list-group mb-3">${itemsHtml}</ul>`;
                document.getElementById('status-label-' + orderId).innerText = data.order_status;

                const progressMap = {
                    'Ordered': 0,
                    'Confirmed': 20,
                    'Preparing': 40,
                    'Waiting for Delivery': 60,
                    'Dispatched ': 80,
                    'Delivered': 100
                };
                document.getElementById('status-bar-' + orderId).style.width = progressMap[data.order_status] + '%';
                document.getElementById('status-bar-' + orderId).innerText = data.order_status;

                if (data.order_status === 'Confirmed' || data.order_status === 'Ordered') {
                    document.getElementById('cancel-form-' + orderId).style.display = 'block';
                } else {
                    document.getElementById('cancel-form-' + orderId).style.display = 'none';
                }
            });
    }
</script>

<script>
let formToSubmit = null;

function showDeleteModal() {
  formToSubmit = document.getElementById('deleteForm-');
  document.getElementById('modalMessage').textContent = `Are you sure you want to cancel?`;
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
@endsection
