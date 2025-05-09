@extends('layouts.admin')

@section('content')
<div style="padding: 30px; background-color: #f5f5f5; min-height: 100vh;">
    <div style="max-width: 800px; margin: auto;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 28px; border-bottom: 1px solid #e0e0e0;">
                <h2 style="font-size: 22px; font-weight: 600; color: #333;">Supplier Details</h2>
                <a href="{{ route('suppliers.index') }}"
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #E7592B; color: white; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px;">
                    <span class="material-icons" style="font-size: 18px; margin-right: 6px;">arrow_back</span> Back to List
                </a>
            </div>

            <div style="padding: 25px 28px;">
                {{-- Supplier "Profile" Header --}}
                <div style="display: flex; align-items: center; margin-bottom: 25px;">
                    <div style="width: 55px; height: 55px; background-color: #E7592B; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: bold; margin-right: 16px;">
                        {{ strtoupper(substr($supplier->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 4px;">{{ $supplier->name }}</h3>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <span style="color: #888;">Supplier ID: {{ str_pad($supplier->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span style="background-color: #f0f0f0; color: #333; font-size: 13px; padding: 2px 10px; border-radius: 12px;">
                                {{ $supplier->category ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- General Info --}}
                <div style="margin-bottom: 20px;">
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">General Information</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <p><strong>Email:</strong><br>{{ $supplier->email }}</p>
                        <p><strong>Phone:</strong><br>{{ $supplier->phone }}</p>
                        <p style="grid-column: span 2;"><strong>Address:</strong><br>{{ $supplier->address }}</p>
                    </div>
                </div>

                <hr style="margin: 20px 0; border: none; border-top: 1px solid #eee;">

                {{-- Contact Person --}}
                <div>
                    <h4 style="font-size: 16px; font-weight: 600; color: #E7592B; margin-bottom: 12px;">Contact Person Details</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <p><strong>Name:</strong><br>{{ $supplier->contact_person_name ?? '-' }}</p>
                        <p><strong>Phone:</strong><br>{{ $supplier->contact_person_phone ?? '-' }}</p>
                        <p style="grid-column: span 2;"><strong>Email:</strong><br>{{ $supplier->contact_person_email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
