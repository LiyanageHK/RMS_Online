@extends('layouts.app')

@section('content')

<div style="padding: 20px;">

    <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0; font-size: 24px; font-weight: bold; color: #000;">
            Edit Driver Allocation
        </h1>
    </div>

    <form action="{{ route('driver.update.delivery', ['delivery_id' => $delivery->delivery_id]) }}" method="POST">
        @csrf
        <div style="background-color: #ffffff; padding: 20px 30px; border-bottom: 1px solid #ddd;">
            <div style="margin-bottom: 15px;">
                <label for="order_id" style="font-weight: bold;">Order ID</label>
                <input type="text" id="order_id" name="order_id" value="{{ $delivery->order_id }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="address" style="font-weight: bold;">Address</label>
                <input type="text" id="address" name="address" value="{{ $delivery->address }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="landmark" style="font-weight: bold;">Landmark</label>
                <input type="text" id="landmark" name="landmark" value="{{ $delivery->landmark }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="phone" style="font-weight: bold;">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ $delivery->phone }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="total" style="font-weight: bold;">Total</label>
                <input type="text" id="total" name="total" value="{{ $delivery->total }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="assigned_to" style="font-weight: bold;">Assigned To</label>
                <input type="text" id="assigned_to" name="assigned_to" value="{{ $delivery->assigned_to }}" style="width: 100%; padding: 8px; border: 1px solid #ddd;">
            </div>

            <div style="margin-bottom: 15px;">
                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; border: none; cursor: pointer;">
                    Save Changes
                </button>
            </div>

        </div>
    </form>

    <div style="margin: 20px 0;">
        <a href="{{ route('driver.allocation.details') }}" style="text-decoration: none; color: #007bff; font-weight: bold; font-size: 16px;">
            ← Back to Allocation Details
        </a>
    </div>

</div>

@endsection
