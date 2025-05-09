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
        <button class="sidebar-btn {{ request()->is('dashboard*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">dashboard</span> Dashboard</span>
        </button>

        <button class="sidebar-btn {{ request()->is('inventory*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">inventory</span> Inventory Center</span>
        </button>

        <!-- Procurement Center -->
        @php
            $procurementExpanded = request()->is('suppliers*') || request()->is('purchase_orders*') || request()->is('grns*');
        @endphp
        <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">business</span> Procurement Center</span>
                <span class="material-icons toggle-icon">{{ $procurementExpanded ? 'expand_less' : 'expand_more' }}</span>
            </button>
            <div class="submenu" style="display: {{ $procurementExpanded ? 'block' : 'none' }}; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="{{ route('suppliers.index') }}" class="submenu-link {{ request()->is('suppliers*') ? 'active' : '' }}">Suppliers</a>
                <a href="{{ route('purchase_orders.index') }}" class="submenu-link {{ request()->is('purchase_orders*') ? 'active' : '' }}">Purchase Orders</a>
                <a href="{{ route('grns.index') }}" class="submenu-link {{ request()->is('grns*') ? 'active' : '' }}">Good Received Notes</a>
            </div>
        </div>

        <button class="sidebar-btn {{ request()->is('customers*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">group</span> Customer Center</span>
        </button>

        <button class="sidebar-btn {{ request()->is('orders*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">shopping_cart</span> Order Center</span>
        </button>

        <button class="sidebar-btn {{ request()->is('delivery*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">local_shipping</span> Delivery Center</span>
        </button>

        <a href="{{ route('employees.index') }}" class="sidebar-btn anchor-btn {{ request()->is('employees*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">people</span> Employee Center</span>
        </a>

        <button class="sidebar-btn {{ request()->is('access-management*') ? 'active' : '' }}">
            <span class="btn-content"><span class="material-icons">security</span> Access Management Center</span>
        </button>

        <!-- Customer Communication -->
        @php
            $communicationExpanded = request()->is('contact-messages*') || request()->is('feedback*');
        @endphp
        <div>
            <button class="sidebar-btn" onclick="toggleMenu(this)">
                <span class="btn-content"><span class="material-icons">chat</span> Customer Communication</span>
                <span class="material-icons toggle-icon">{{ $communicationExpanded ? 'expand_less' : 'expand_more' }}</span>
            </button>
            <div class="submenu" style="display: {{ $communicationExpanded ? 'block' : 'none' }}; margin-left: 20px; margin-top: 6px; text-align: left;">
                <a href="{{ route('contact.index') }}" class="submenu-link {{ request()->is('contact-messages*') ? 'active' : '' }}">Contact Us</a>
                <a href="{{ route('feedback.index') }}" class="submenu-link {{ request()->is('feedback*') ? 'active' : '' }}">Feedback</a>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar Styling -->
<style>
    .sidebar-btn,
    .anchor-btn {
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
        margin-bottom: 6px;
        text-align: left;
        text-decoration: none;
        box-sizing: border-box;
    }

    .sidebar-btn:hover,
    .anchor-btn:hover {
        background-color: #e0e0e0;
    }

    .sidebar-btn.active,
    .anchor-btn.active {
        background-color: #E7592B;
        color: white;
        font-weight: bold;
    }

    .btn-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .submenu-link {
        display: block;
        padding: 10px 16px;
        width: 100%;
        color: #555;
        text-decoration: none;
        font-size: 15px;
        border-radius: 6px;
        background-color: #f8f8f8;
        margin-bottom: 6px;
        box-sizing: border-box;
    }

    .submenu-link:hover {
        background-color: #e0e0e0;
        color: #E7592B;
    }

    .submenu-link.active {
        background-color: #E7592B;
        color: white;
        font-weight: bold;
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

<!-- Toggle Submenu Script -->
<script>
    function toggleMenu(button) {
        const submenu = button.nextElementSibling;
        const icon = button.querySelector('.toggle-icon');

        const isVisible = submenu.style.display === "block";
        submenu.style.display = isVisible ? "none" : "block";
        icon.textContent = isVisible ? "expand_more" : "expand_less";
    }
</script>
