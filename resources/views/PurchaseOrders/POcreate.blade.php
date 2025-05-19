@extends('layouts.app')

@section('title', 'Create Purchase Order')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 1000px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Create Purchase Order</h2>
            <a href="{{ route('purchase_orders.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('purchase_orders.store') }}" method="POST">
            @csrf

            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9; margin-bottom: 30px;">
                <div style="margin-bottom: 20px;">
                    <label for="supplier_id" style="font-weight: bold;">Supplier <span style="color: red;">*</span></label>
                    <select id="supplier_id" name="supplier_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="order_date" style="font-weight: bold;">Order Date <span style="color: red;">*</span></label>
                    <input type="date" id="order_date" name="order_date" value="{{ date('Y-m-d') }}" readonly style="width: 98%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f3f3f3;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="delivery_date" style="font-weight: bold;">Delivery Date</label>
                    <input type="date" id="delivery_date" name="delivery_date" min="{{ date('Y-m-d') }}" style="width: 98%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
            </div>

            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background-color: #F9F9F9;">
                <h4 style="font-weight: bold; margin-bottom: 10px;">Order Items</h4>
                <div style="margin-bottom: 10px;">
                    <select id="item_select" style="width: 99%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">-- Choose an Item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}">
                                {{ $item->name }} - ${{ number_format($item->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <table id="items_table">
                    <thead>
                        <tr style="background-color: #e8e8e8;">
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr style="background-color: #f5f5f5;">
                            <td colspan="3" style="text-align: right; font-weight: bold;">Total Amount:</td>
                            <td>
                                <input type="text" id="total_amount" name="total_amount" readonly style="width: 100px; padding: 5px; border: none; background-color: #f3f3f3;">
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <div style="display: flex; gap: 10px;">
                    <button type="submit" name="action" value="draft" style="background-color: #6c757d; color: white; font-size: 14px; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">
                        Save as Draft
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
            <button id="cancelSendEmailBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
            <button id="confirmSendEmailBtn" style="padding: 10px 20px; background-color: #0070FF; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Send</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const itemSelect = document.getElementById('item_select');
    const tableBody = document.querySelector('#items_table tbody');
    const totalAmount = document.getElementById('total_amount');
    const addedItemIds = new Set();

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
            <td>
                ${itemName}
                <input type="hidden" name="items[${itemId}][item_id]" value="${itemId}">
                <input type="hidden" name="items[${itemId}][name]" value="${itemName}">
            </td>
            <td>
                $${itemPrice.toFixed(2)}
                <input type="hidden" name="items[${itemId}][price]" value="${itemPrice}">
            </td>
            <td>
                <input type="number" name="items[${itemId}][quantity]" value="1" min="1" class="qty-input" style="width: 60px; padding: 5px;">
            </td>
            <td class="item-total">$${itemPrice.toFixed(2)}</td>
            <td style="text-align: center;">
    <button type="button" class="remove-btn" style="color: #dc3545; border: none; background: none; cursor: pointer; display: flex; align-items: center; gap: 5px;cursor: pointer;">
        <span class="material-icons">delete</span>
        <span style="font-weight: bold;">Delete</span>
    </button>
</td>
        `;
        tableBody.appendChild(row);
        updateTotalAmount();
    });

    tableBody.addEventListener('input', function (e) {
        if (e.target.classList.contains('qty-input')) {
            let value = parseInt(e.target.value) || 1;
            if (value < 1) {
                e.target.value = 1;
                value = 1;
            }
            const row = e.target.closest('tr');
            const price = parseFloat(row.querySelector('input[name$="[price]"]').value);
            const total = (price * value).toFixed(2);
            row.querySelector('.item-total').textContent = `$${total}`;
            updateTotalAmount();
        }
    });

    // Prevent manual entry of numbers less than 1
    tableBody.addEventListener('change', function (e) {
        if (e.target.classList.contains('qty-input')) {
            let value = parseInt(e.target.value) || 1;
            if (value < 1) {
                e.target.value = 1;
            }
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
        totalAmount.value = `$${total.toFixed(2)}`;
    }


    document.getElementById('poForm').addEventListener('submit', function(e) {
        const form = this;
        const action = document.activeElement.value;
        const supplier = document.getElementById('supplier_id').value;
        const deliveryDate = document.getElementById('delivery_date').value;
        let hasItems = false;
        let invalidQty = false;
        document.querySelectorAll('#items_table tbody tr').forEach(row => {
            hasItems = true;
            const qty = parseInt(row.querySelector('.qty-input').value) || 0;
            if (qty < 1) invalidQty = true;
        });

        // Use a hidden input to always set the action
        let poAction = document.getElementById('po_action');
        if (!poAction) {
            poAction = document.createElement('input');
            poAction.type = 'hidden';
            poAction.id = 'po_action';
            poAction.name = 'action';
            form.appendChild(poAction);
        }
        poAction.value = action;

        if (action === 'send') {
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
            } else if (invalidQty) {
                valid = false;
                errorMsg = 'Quantity must be at least 1 for all items.';
            }
            if (!valid) {
                e.preventDefault();
                alert(errorMsg);
            } else {
                // Show custom confirmation modal
                e.preventDefault();
                document.getElementById('sendEmailModal').style.display = 'flex';
                // Only submit if user confirms
                document.getElementById('confirmSendEmailBtn').onclick = function() {
                    poAction.value = 'send';
                    document.getElementById('sendEmailModal').style.display = 'none';
                    form.submit();
                };
                document.getElementById('cancelSendEmailBtn').onclick = function() {
                    document.getElementById('sendEmailModal').style.display = 'none';
                };
            }
        } else if (action === 'draft') {
            if (!supplier) {
                e.preventDefault();
                alert('Please select a supplier to save as draft.');
            } else if (invalidQty) {
                e.preventDefault();
                alert('Quantity must be at least 1 for all items.');
            }
        }
    });

</script>

<style>
    #items_table th, #items_table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        vertical-align: middle;
    }

    #items_table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    #items_table input[type="number"],
    #items_table input[type="text"] {
        width: 100%;
        box-sizing: border-box;
    }

    #items_table tfoot td {
        font-weight: bold;
        background-color: #f5f5f5;
    }
</style>
@endpush
