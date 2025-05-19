@extends('layouts.app')

@section('content')
    <!-- Top Row -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 30px;">
        <h2 style="font-size: 20px; margin: 0; font-weight: bold;">Suppliers</h2>
        <form method="GET" action="{{ route('suppliers.index') }}">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search suppliers..."
                   oninput="if(this.value==='') this.form.submit();"
                   style="padding: 10px 12px; width: 260px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </form>
    </div>

    <!-- Table Section -->
    <div style="border: 1px solid #ddd; border-radius: 10px; background-color: #ffffff; padding: 25px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin: 0 30px 40px 30px;">
        <!-- Section Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; font-size: 18px; color: #333;">Overview</h3>
            <a href="{{ route('suppliers.create') }}"
               style="padding: 8px 14px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 6px; font-size: 14px;">
                + Add New Supplier
            </a>
        </div>

        <!-- Suppliers Table -->
        <div style="max-height: 450px; overflow-y: auto; width: 100%;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                <thead style="background-color: #f9f9f9; position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th style="padding: 12px; text-align: left; font-weight: 600; background: #f9f9f9;">Supplier ID</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; background: #f9f9f9;">Name</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; background: #f9f9f9;">Category</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; background: #f9f9f9;">Email</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; background: #f9f9f9;">Contact Person</th>
                        <th style="padding: 12px; text-align: right; background: #f9f9f9;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr style="background-color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                            <td style="padding: 12px;">SUP{{ str_pad($supplier->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td style="padding: 12px;">{{ $supplier->name }}</td>
                            <td style="padding: 12px;">
                                @if ($supplier->category)
                                <span style="background-color: #f0f0f0; color: #333; font-size: 13px; padding: 4px 10px; border-radius: 12px;">
                                    {{ ucfirst($supplier->category) }}
                            </span>
                            @else
                            -
                            @endif
                        </td>
                        <td style="padding: 12px;">{{ $supplier->email }}</td>
                        <td style="padding: 12px;">
                            {{ $supplier->contact_person_name }}<br>
                            {{ $supplier->contact_person_phone }}
                        </td>
                        <td style="padding: 12px; text-align: right;">
                            <a href="{{ route('suppliers.show', $supplier->id) }}" style="margin-right: 8px; background-color: #6c757d; color: white; padding: 6px 10px; border-radius: 4px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">visibility</span> View
                            </a>
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" style="margin-right: 8px; background-color: #007bff; color: white; padding: 6px 10px; border-radius: 4px; font-size: 13px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span class="material-icons" style="font-size: 16px; margin-right: 4px;">edit</span> Edit
                            </a>
                            <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="delete-form" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-button" data-name="{{ $supplier->name }}" style="background-color: #dc3545; color: white; padding: 6px 10px; border: none; border-radius: 4px; font-size: 13px; display: inline-flex; align-items: center; cursor: pointer;">
                                    <span class="material-icons" style="font-size: 16px; margin-right: 4px;">delete</span> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 12px; text-align: center;">No suppliers found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Confirmation Modal (same as before) -->
    <div id="confirmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 9999;">
        <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
            <div style="margin-bottom: 15px;">
                <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
            </div>
            <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
            <p id="modalMessage" style="font-size: 15px; margin-bottom: 25px;">Are you sure you want to delete this supplier?</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button id="cancelBtn" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                <button id="confirmDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Delete</button>
            </div>
        </div>
    </div>

    <!-- Error/Confirmation Modal for Supplier Delete (from session) -->
    @if(session('confirm_supplier_delete'))
        <div id="confirmSupplierDeleteModal" style="display: flex; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center; z-index: 99999;">
            <div style="background-color: #fff; padding: 30px; border-radius: 12px; width: 400px; max-width: 90%; box-shadow: 0 10px 25px rgba(0,0,0,0.15); text-align: center;">
                <div style="margin-bottom: 15px;">
                    <span class="material-icons" style="font-size: 40px; color: #dc3545;">warning</span>
                </div>
                <h4 style="margin-bottom: 10px; font-size: 18px; color: #333;">Confirm Deletion</h4>
                <p style="font-size: 15px; margin-bottom: 25px;">This supplier is linked to a GRN. Are you sure you want to delete?</p>
                <div style="display: flex; justify-content: center; gap: 10px;">
                    <button id="cancelSupplierDeleteBtn" type="button" style="padding: 10px 20px; background-color: #6c757d; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Cancel</button>
                    <form id="confirmSupplierDeleteForm" method="POST" action="{{ route('suppliers.destroy', session('confirm_supplier_delete')) }}" style="display: inline; margin: 0;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="confirmed" value="1">
                        <button type="submit" id="confirmSupplierDeleteBtn" style="padding: 10px 20px; background-color: #dc3545; border: none; color: #fff; border-radius: 5px; font-weight: bold; font-size: 14px; cursor: pointer;">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.body.style.overflow = 'hidden';
            document.getElementById('confirmSupplierDeleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
            document.getElementById('cancelSupplierDeleteBtn').addEventListener('click', function() {
                document.getElementById('confirmSupplierDeleteModal').style.display = 'none';
                document.body.style.overflow = '';
                // Remove the confirm_supplier_delete from the URL/session by reloading without it
                window.location = '{{ route('suppliers.index') }}';
            });
        </script>
    @endif
    @if(session('error') && !session('confirm_supplier_delete') && !(session('error') && (session('error') == 'This supplier is linked to a Purchase Order with status Sent. You cannot delete this supplier.' || session('error') == 'This supplier is linked to a Draft Purchase Order. Please edit or delete the PO(s) first before deleting the supplier.')))
        <div class="alert alert-danger" style="margin: 20px 30px 0 30px;">{{ session('error') }}</div>
    @endif

    <!-- Modal Script (same as before) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let formToSubmit = null;

            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function () {
                    formToSubmit = this.closest('form');
                    const name = this.getAttribute('data-name');
                    document.getElementById('modalMessage').textContent = `Are you sure you want to delete "${name}"?`;
                    document.getElementById('confirmModal').style.display = 'flex';
                });
            });

            document.getElementById('cancelBtn').addEventListener('click', function () {
                document.getElementById('confirmModal').style.display = 'none';
                formToSubmit = null;
            });

            document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
                if (formToSubmit) formToSubmit.submit();
            });
        });
    </script>
@endsection
