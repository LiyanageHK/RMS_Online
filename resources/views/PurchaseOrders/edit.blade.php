@extends('layouts.app')

@section('title', 'Edit Purchase Order')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 1000px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Edit Purchase Order</h2>
            <a href="{{ route('purchase_orders.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('purchase_orders.update', $po->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- PO Details -->
            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9; margin-bottom: 30px;">
                <div style="margin-bottom: 20px;">
                    <label for="supplier_id" style="font-weight: bold;">Supplier <span style="color: red;">*</span></label>
                    <select id="supplier_id" name="supplier_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supplier->id == $po->supplier_id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="order_date" style="font-weight: bold;">Order Date <span style="color: red;">*</span></label>
                    <input type="date" id="order_date" name="order_date" value="{{ $po->order_date }}" readonly style="width: 98%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="delivery_date" style="font-weight: bold;">Delivery Date</label>
                    <input type="date" id="delivery_date" name="delivery_date" value="{{ $po->delivery_date }}" min="{{ date('Y-m-d') }}" style="width: 98%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <div>
                    <label for="total_amount" style="font-weight: bold;">Total Amount </label>
                    <input type="text" id="total_amount" name="total_amount" readonly style="width: 98%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f3f3f3;" value="{{ number_format($po->total_amount, 2) }}">
                </div>
            </div>

            <!-- Item Selection -->
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background-color: #F9F9F9;">
                <h4 style="font-weight: bold; margin-bottom: 10px;">Order Items</h4>
                <div style="margin-bottom: 10px;">
                    <select id="item_select" style="width: 99%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; padding-right: 30px;">
                        <option value="">-- Choose an Item to Order --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
                                {{ $item->name }} - ${{ number_format($item->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <table id="items_table" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #e8e8e8;">
                            <th style="padding: 10px; text-align: left;">Item Name</th>
                            <th style="padding: 10px; text-align: left;">Price</th>
                            <th style="padding: 10px; text-align: left;">Quantity</th>
                            <th style="padding: 10px; text-align: left;">Total</th>
                            <th style="padding: 10px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($po->items as $poItem)
                            <tr data-id="{{ $poItem->item_id }}">
                                <td style="padding: 10px;">
                                    {{ $poItem->item->name }}
                                    <input type="hidden" name="items[{{ $poItem->item_id }}][item_id]" value="{{ $poItem->item_id }}">
                                    <input type="hidden" name="items[{{ $poItem->item_id }}][name]" value="{{ $poItem->item->name }}">
                                </td>
                                <td style="padding: 10px;">
                                    ${{ number_format($poItem->price, 2) }}
                                    <input type="hidden" name="items[{{ $poItem->item_id }}][price]" value="{{ $poItem->price }}">
                                </td>
                                <td style="padding: 10px;">
                                    <input type="number" name="items[{{ $poItem->item_id }}][quantity]" value="{{ $poItem->quantity }}" min="1" class="qty-input" style="width: 60px; padding: 5px;">
                                </td>
                                <td class="item-total" style="padding: 10px;">
                                    ${{ number_format($poItem->price * $poItem->quantity, 2) }}
                                </td>
                                <td style="padding: 10px; text-align: center;">
                                    <button type="button" class="remove-btn" style="color: #e74c3c; border: none; background: none; cursor: pointer;">
                                        <span class="material-icons">delete</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <div style="display: flex; gap: 10px;">
                    <button type="submit" name="action" value="draft" style="background-color: #6c757d; color: white; font-size: 14px; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">
                        Update PO
                    </button>
                    <button type="submit" id="sendEmailBtn" name="action" value="send" class="btn btn-success" style="background-color: #0070FF; color: white; font-size: 14px; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">
                        Send as Email
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="sendEmailModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
    <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
        <div style="margin-bottom: 15px;">
            <span class="material-icons" style="font-size: 40px; color: #0070FF;">email</span>
        </div>
        <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Send Purchase Order as Email?</h4>
        <p style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to send this purchase order as an email to the supplier?</p>
        <div style="display: flex; justify-content: center; gap: 15px;">
            <button id="cancelSendEmailBtn" type="button" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
            <button id="confirmSendEmailBtn" type="button" style="padding: 10px 20px; background-color: #0070FF; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Send</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const itemSelect = document.getElementById('item_select');
    const tableBody = document.querySelector('#items_table tbody');
    const totalAmount = document.getElementById('total_amount');

    const addedItemIds = new Set([
        @foreach($po->items as $poItem)
            '{{ $poItem->item_id }}',
        @endforeach
    ]);

    itemSelect.addEventListener('change', function () {
        const selected = itemSelect.options[itemSelect.selectedIndex];
        const itemId = selected.value;
        const itemName = selected.getAttribute('data-name');
        const itemPrice = parseFloat(selected.getAttribute('data-price'));

        if (!itemId || addedItemIds.has(itemId)) return;
        addedItemIds.add(itemId);

        const row = document.createElement('tr');
        row.setAttribute('data-id', itemId);
        row.innerHTML = `
            <td style="padding: 10px;">
                ${itemName}
                <input type="hidden" name="items[${itemId}][item_id]" value="${itemId}">
                <input type="hidden" name="items[${itemId}][name]" value="${itemName}">
            </td>
            <td style="padding: 10px;">
                $${itemPrice.toFixed(2)}
                <input type="hidden" name="items[${itemId}][price]" value="${itemPrice}">
            </td>
            <td style="padding: 10px;">
                <input type="number" name="items[${itemId}][quantity]" value="1" min="1" class="qty-input" style="width: 60px; padding: 5px;">
            </td>
            <td class="item-total" style="padding: 10px;">$${itemPrice.toFixed(2)}</td>
            <td style="padding: 10px; text-align: center;">
                <button type="button" class="remove-btn" style="color: #e74c3c; border: none; background: none; cursor: pointer;">
                    <span class="material-icons">delete</span>
                </button>
            </td>
        `;
        tableBody.appendChild(row);
        updateTotalAmount();
    });

    tableBody.addEventListener('input', function (e) {
        if (e.target.classList.contains('qty-input')) {
            const row = e.target.closest('tr');
            const price = parseFloat(row.querySelector('input[name$="[price]"]').value);
            const qty = parseInt(e.target.value) || 0;
            const total = (price * qty).toFixed(2);
            row.querySelector('.item-total').textContent = `$${total}`;
            updateTotalAmount();
        }
    });

    tableBody.addEventListener('click', function (e) {
        if (e.target.closest('.remove-btn')) {
            const row = e.target.closest('tr');
            const itemId = row.getAttribute('data-id');
            addedItemIds.delete(itemId);
            row.remove();
            updateTotalAmount();
        }
    });

    function updateTotalAmount() {
        let total = 0;
        tableBody.querySelectorAll('tr').forEach(row => {
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            const price = parseFloat(row.querySelector('input[name$="[price]"]').value);
            total += qty * price;
        });
        totalAmount.value = total.toFixed(2);
    }

    // Run on load to calculate initial total
    updateTotalAmount();


    let pendingSendEmail = false;
    let poAction = null; // Track which button was clicked
    
    // Set poAction on button click
    document.getElementById('sendEmailBtn').addEventListener('click', function(e) {
        poAction = 'send';
    });
    document.querySelector('button[name="action"][value="draft"]').addEventListener('click', function(e) {
        poAction = 'draft';
    });

    // Ensure a hidden input for action exists
    let actionInput = document.createElement('input');
    actionInput.type = 'hidden';
    actionInput.name = 'action';
    document.getElementById('poForm').appendChild(actionInput);

    document.getElementById('poForm').addEventListener('submit', function(e) {
        const form = this;
        const supplier = document.getElementById('supplier_id').value;
        const deliveryDate = document.getElementById('delivery_date').value;
        let hasItems = false;
        document.querySelectorAll('#items_table tbody tr').forEach(row => { hasItems = true; });

        if (poAction === 'send') {
            let valid = true;
            let errorMsg = '';
            if (!supplier) {
                valid = false;
                errorMsg = 'Please select a supplier.';
            } else if (!deliveryDate) {
                valid = false;
                errorMsg = 'Please select a delivery date.';
            } else if (!hasItems) {
                valid = false;
                errorMsg = 'Please add at least one item.';
            }
            if (!valid) {
                e.preventDefault();
                alert(errorMsg);
            } else {
                e.preventDefault();
                document.getElementById('sendEmailModal').style.display = 'flex';
                document.getElementById('confirmSendEmailBtn').onclick = function() {
                    document.getElementById('sendEmailModal').style.display = 'none';
                    actionInput.value = 'send';
                    poAction = null;
                    // Remove name from submit buttons to avoid duplicate 'action' fields
                    document.querySelectorAll('button[name="action"]').forEach(btn => btn.removeAttribute('name'));
                    form.submit();
                };
                document.getElementById('cancelSendEmailBtn').onclick = function() {
                    document.getElementById('sendEmailModal').style.display = 'none';
                    poAction = null;
                };
            }
        } else if (poAction === 'draft') {
            if (!supplier) {
                e.preventDefault();
                alert('Please select a supplier to save as draft.');
            } else {
                actionInput.value = 'draft';
                poAction = null;
            }
        } else {
            actionInput.value = 'draft';
        }
    });


</script>
@endpush
