@extends('layouts.app')

@section('title', 'Create GRN')

@section('content')
<div style="display: flex; justify-content: center; width: 100%; margin-top: 40px;">
    <div style="width: 90%; max-width: 1000px; border: 2px solid #ddd; padding: 30px; background-color: #ffffff; border-radius: 10px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); position: relative;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; font-size: 24px; margin: 0;">Create GRN</h2>
            <a href="{{ route('grns.index') }}" title="Cancel" style="color: #666; text-decoration: none;">
                <span class="material-icons" style="font-size: 28px;">close</span>
            </a>
        </div>

        <form action="{{ route('grns.store') }}" method="POST">
            @csrf

            <!-- GRN Details -->
            <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background-color: #F9F9F9; margin-bottom: 30px;">
                <div style="margin-bottom: 20px;">
                    <label for="grn_date" style="font-weight: bold;">GRN Date <span style="color: red;">*</span></label>
                    <input type="date" id="grn_date" name="grn_date" value="{{ date('Y-m-d') }}" readonly style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background-color: #f3f3f3;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="reference_number" style="font-weight: bold;">Reference PO (optional)</label>
                    <select id="reference_number" name="reference_number" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">-- Select PO --</option>
                        @foreach($purchaseOrders as $po)
                            @if($po->status === 'Sent')
                                <option value="{{ $po->id }}" data-supplier="{{ $po->supplier_id }}" data-items='@json($po->items)'>PO{{ str_pad($po->id, 5, '0', STR_PAD_LEFT) }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="supplier_id" style="font-weight: bold;">Supplier <span style="color: red;">*</span></label>
                    <select id="supplier_id" name="supplier_id" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Select Supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Item Selection -->
            <div style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background-color: #F9F9F9;">
                <h4 style="font-weight: bold; margin-bottom: 10px;">Received Items</h4>
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

            <!-- Submit Button -->
            <div style="display: flex; justify-content: flex-end; margin-top: 30px;">
                <button type="submit" style="background-color: #E7592B; color: white; font-size: 14px; padding: 10px 18px; border: none; border-radius: 5px; cursor: pointer;">
                    Save GRN
                </button>
            </div>
        </form>
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
        totalAmount.value = `$${total.toFixed(2)}`;
    }

    // Autofill supplier and items when PO is selected
    const referenceSelect = document.getElementById('reference_number');
    const supplierSelect = document.getElementById('supplier_id');

    referenceSelect.addEventListener('change', function() {
        const selected = referenceSelect.options[referenceSelect.selectedIndex];
        const supplierId = selected.getAttribute('data-supplier');
        const itemsJson = selected.getAttribute('data-items');
        if (supplierId) {
            supplierSelect.value = supplierId;
            supplierSelect.removeAttribute('disabled'); // ensure enabled
            supplierSelect.setAttribute('name', 'supplier_id');
        } else {
            supplierSelect.value = '';
            supplierSelect.removeAttribute('disabled');
            supplierSelect.setAttribute('name', 'supplier_id');
        }
        // Clear current items
        tableBody.innerHTML = '';
        addedItemIds.clear();
        if (itemsJson) {
            try {
                const items = JSON.parse(itemsJson.replace(/&quot;/g, '"'));
                if (items.length > 0) {
                    console.log('First PO item object:', items[0]);
                }
                items.forEach(function(item) {
                    // Use item.item_id for item ID and item.name for item name
                    addedItemIds.add(String(item.item_id));
                    const itemName = item.name || '';
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', item.item_id);
                    row.innerHTML = `
                        <td>
                            ${itemName}
                            <input type="hidden" name="items[${item.item_id}][item_id]" value="${item.item_id}">
                            <input type="hidden" name="items[${item.item_id}][name]" value="${itemName}">
                        </td>
                        <td>
                            $${parseFloat(item.price).toFixed(2)}
                            <input type="hidden" name="items[${item.item_id}][price]" value="${item.price}">
                        </td>
                        <td>
                            <input type="number" name="items[${item.item_id}][quantity]" value="${item.quantity}" min="1" class="qty-input" style="width: 60px; padding: 5px;">
                        </td>
                        <td class="item-total">$${(parseFloat(item.price) * parseInt(item.quantity)).toFixed(2)}</td>
                        <td style="text-align: center;">
                            <button type="button" class="remove-btn" style="color: #dc3545; border: none; background: none; cursor: pointer; display: flex; align-items: center; gap: 5px;cursor: pointer;">
                                <span class="material-icons">delete</span>
                                <span style="font-weight: bold;">Delete</span>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
                updateTotalAmount();
            } catch (e) {
                // ignore parse errors
            }
        } else {
            updateTotalAmount();
        }
    });

    // Ensure supplier select is enabled and has a name before submit so its value is sent
    const grnForm = document.querySelector('form[action*="grns.store"]');
    grnForm.addEventListener('submit', function() {
        supplierSelect.removeAttribute('disabled');
        supplierSelect.setAttribute('name', 'supplier_id');
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
