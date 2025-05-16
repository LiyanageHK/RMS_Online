<div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
    <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
        @if(request()->is('suppliers*') || request()->is('purchase_orders*') || request()->is('grns*'))
            Procurement Center
        @elseif(request()->is('employees*'))
            Employee Center
        @elseif(request()->is('inventory-center*'))
            Inventory Center
        @elseif(request()->is('order-center*'))
            Order Center
        @elseif(request()->is('delivery-center*'))
            Delivery Center
        @elseif(request()->is('access-management-center*'))
            Access Management Center
        @elseif(request()->is('contact-messages*') || request()->is('feedback*'))
            Customer Communication
        @else
            Dashboard
        @endif
    </h1>
    <div style="display: flex; align-items: center; gap: 12px;">
        <a href="#" style="text-decoration: none; color: #000; font-size: 14px;">Logout</a>
        <div style="width: 40px; height: 40px; background-color: #E7592B; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <span class="material-icons" style="color: #fff; font-size: 20px;">person</span>
        </div>
    </div>
</div>
