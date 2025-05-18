<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flame & Crust - Inventory Center</title>
    
    <!-- Bootstrap CSS (or any other CSS frameworks) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f4f4;
        }
        .sidebar {
            background-color: #1c1c1c;
            height: 100vh;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #e63946;
        }
        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .content-area {
            padding: 30px;
        }
        .btn-red {
            background-color: #e63946;
            color: white;
        }
        .btn-red:hover {
            background-color: #c5303b;
        }
        .btn-ash {
            background-color: #ccc;
            color: black;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-center mb-4">🔥 Flame & Crust</h4>
            <a href="#">Dashboard</a>
            <a href="#">Access Management</a>
            <a href="#">Inventory Center</a>
            <a href="#">Employee Center</a>
            <a href="#">Suppliers</a>
            <a href="#">Customers</a>
            <a href="#">Orders</a>
            <a href="#">Delivery Center</a>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="topbar">
                <i class="bi bi-bell fs-4 me-3"></i>
                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Admin" />
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <h3 class="mb-4">Inventory Center</h3>

                <!-- Buttons -->
                <div class="mb-4 d-flex gap-3">
                    <a href="#" class="btn btn-red">Item Master</a>
                    <a href="#" class="btn btn-red">Item Category</a>
                    <a href="#" class="btn btn-red">Production Center</a>
                </div>

                <!-- Search + Download -->
                <div class="d-flex justify-content-between mb-3">
                    <input type="text" class="form-control w-50" placeholder="Search items...">
                    <button class="btn btn-ash">Download Report</button>
                </div>

                <!-- Inventory Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped bg-white">
                        <thead class="table-dark">
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Inventory Rows -->
                            <tr>
                                <td>ITM001</td>
                                <td>Tomato Sauce</td>
                                <td>50</td>
                                <td>Liters</td>
                                <td>Used in base preparation</td>
                            </tr>
                            <tr>
                                <td>ITM002</td>
                                <td>Cheese</td>
                                <td>30</td>
                                <td>Kgs</td>
                                <td>Mozzarella topping</td>
                            </tr>
                            <!-- Add dynamic rows based on your database later -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS (or any other JS libraries) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php /**PATH C:\HIRUNI LIYANAGE\SLIIT\Y3\S2\IE3011 - IS Project Management\ASSIGNMENT\RMS v2\RMS_Online\resources\views\InventoryCenter.blade.php ENDPATH**/ ?>