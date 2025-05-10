<div style="width: 250px; background-color: #ffffff; color: #333; padding: 20px; box-shadow: 2px 0px 8px rgba(0, 0, 0, 0.05); display: flex; flex-direction: column;">
    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 25px;">
        <img src="{{ asset('images/Logo.svg') }}" alt="Logo" style="width: 80px;">
        <div style="margin-top: 10px;">
            <div style="font-size: 22px; color: #E7592B; font-family: 'Castoro Titling'; font-weight: bold;">FLAME & CRUST</div>
            <div style="font-size: 14px; color: #888; font-family: 'Gloock';">PIZZERIA</div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div id="sidebarMenu" style="flex-grow: 1;">
        <button class="sidebar-btn">
            <span class="btn-content"><span class="material-icons">dashboard</span> Dashboard</span>
        </button>

        <button class="sidebar-btn">
            <span class="btn-content"><span class="material-icons">inventory</span> Inventory Center</span>
        </button>

         <!-- Procurement Center -->
         <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">business</span> Procurement Center</span>
                <span class="material-icons toggle-icon">expand_more</span>
            </button>
            <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="#" class="submenu-link">Suppliers</a>
                <a href="#" class="submenu-link">Purchase Orders</a>
                <a href="#" class="submenu-link">Good Received Notes</a>
            </div>
        </div>




          <!-- Customer Center -->
          <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">group</span> Customer Center</span>
                <span class="material-icons toggle-icon">expand_more</span>
            </button>
            <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="http://localhost:8000/admin/customer/overview#" class="submenu-link">Customer Overview</a>
                <a href="{{ route('loyalty-program') }}"  class="submenu-link" onclick="showLoyaltyTable()">Loyalty Program</a>
                <!-- <a href="#" class="submenu-link">Email Services</a> -->
            </div>
        </div>



        <button class="sidebar-btn">
            <span class="btn-content"><span class="material-icons">shopping_cart</span> Order Center</span>
        </button>



        <!-- Delivery Center -->
        <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">group</span> Delivery Center</span>
                <span class="material-icons toggle-icon">expand_more</span>
            </button>
            <div class="submenu" style="display: none; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="#" class="submenu-link">History</a>
                <a href="#" class="submenu-link">Driver</a>
                <a href="{{ route('pending-allocation') }}" class="submenu-link">Driver Allocation</a>
            </div>
        </div>


        <button class="sidebar-btn">
            <span class="btn-content"><span class="material-icons">people</span> Employee Center</span>
        </button>

        <button class="sidebar-btn">
            <span class="btn-content"><span class="material-icons">security</span> Access Management Center</span>
        </button>
    </div>
</div>

<!-- Sidebar Styling -->
<style>
    .sidebar-btn {
        background-color: #f8f8f8;
        color: #333;
        font-size: 15px;
        padding: 12px 16px;
        width: 100%;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .sidebar-btn:hover {
        background-color: #e0e0e0;
    }

    .btn-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .submenu-link {
        display: block;
        padding: 8px 15px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
        border-radius: 4px;
    }

    .submenu-link:hover {
        background-color: #f0f0f0;
        color: #E7592B;
    }

    .toggle-icon {
        font-size: 18px;
        color: #888;
    }

    .material-icons {
        vertical-align: middle;
        font-size: 20px;
    }
</style>

<script>
    function toggleMenu(button) {
        const submenu = button.nextElementSibling;
        const icon = button.querySelector('.toggle-icon');
        if (submenu.style.display === "none" || submenu.style.display === "") {
            submenu.style.display = "block";
            icon.textContent = "expand_less";
        } else {
            submenu.style.display = "none";
            icon.textContent = "expand_more";
        }
    }
</script>
