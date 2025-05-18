<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Delivery;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class DriverController extends Controller
{
    // Show orders pending driver allocation
    public function pendingAllocation()
    {
        $orders = Order::where('order_status', 'Waiting for Delivery')->get();

        return view('driver.pendingAllocation', [
            'orders' => $orders,
            'section' => 'delivery', // or 'customer' based on context
        ]);



    }


public function allocateDriver(Request $request)
{
    $order_id = $request->query('order_id'); // gets ?order_id=4 from the URL

    $order = Order::findOrFail($order_id);
    $drivers = Employee::where('position', 'Driver')->get();
    $delivery = Delivery::firstOrNew(['order_id' => $order_id]);

    return view('driver.driverAllocation', [
        'order' => $order,
        'drivers' => $drivers,
        'delivery' => $delivery,
        'section' => 'delivery'
    ]);
}


    // In DriverController.php

    public function allocationDetails()
    {
        $deliveries = Delivery::all();
        $section = 'delivery'; 

        return view('driver.allocation_details', compact('deliveries', 'section'));
    }


    // Save the allocated driver to the order
    public function storeAllocation(Request $request)
    {
        $validated = $request->validate([
            'order_id'  => 'required|exists:orders,id',
            'driver_id' => 'required|exists:employees,id',
            'address'   => 'required|string|max:255',
            'landmark'  => 'nullable|string|max:255',
            'phone'     => 'required|string|max:20',
            'total'     => 'nullable|numeric',
        ]);

        $delivery = Delivery::firstOrNew(['order_id' => $validated['order_id']]);
        $delivery->fill([
            'driver_id'   => $validated['driver_id'],
            'address'     => $validated['address'],
            'landmark'    => $validated['landmark'],
            'phone'       => $validated['phone'],
             'total'       => $validated['total'],
            'assigned_to' => Employee::find($validated['driver_id'])->name ?? null,
        ])->save();

        // Update the order status to "Dispatched"
        $order = Order::find($validated['order_id']);
        $order->order_status = 'Dispatched';
        $order->save();

        return redirect()
        ->route('admin.driver.allocate', ['order_id' => $validated['order_id']])
        ->with('success', 'Driver allocated successfully!');
  }





// Show the edit form for a delivery



// Handle the update of the delivery details
public function editDelivery(Request $request, $delivery_id)
{
    // Check if it's a PUT request (i.e., form submission)
    if ($request->isMethod('put')) {
        $validated = $request->validate([
            'order_id'  => 'required|exists:orders,id',
            'driver_id' => 'required|exists:employees,id',
            'address'   => 'required|string|max:255',
            'landmark'  => 'nullable|string|max:255',
            'phone'     => 'required|string|max:20',
            'total'     => 'nullable|numeric',
        ]);

        $delivery = Delivery::findOrFail($delivery_id);
        $delivery->order_id = $validated['order_id'];
        $delivery->driver_id = $validated['driver_id'];
        $delivery->address = $validated['address'];
        $delivery->landmark = $validated['landmark'];
        $delivery->phone = $validated['phone'];
        $delivery->total = $validated['total'];
        $delivery->assigned_to = Employee::find($validated['driver_id'])->name ?? null;

        $delivery->save();

        return redirect()->route('admin.driver.allocation.details')->with('success', 'Delivery updated successfully.');
    }

    // Otherwise, show the edit form
    $delivery = Delivery::where('delivery_id', $delivery_id)->firstOrFail();
    $drivers = Employee::where('position', 'Driver')->get();

    return view('driver.edit_delivery', [
        'delivery' => $delivery,
        'drivers' => $drivers,
        'section' => 'delivery'
    ]);
}



  public function deleteDelivery($delivery_id)
  {

      DB::table('delivery')->where('delivery_id', $delivery_id)->delete();

      return redirect()->route('admin.driver.allocation.details')->with('success', 'Delivery deleted successfully');
  }




public function driverListView()
{
    $drivers = Employee::where('position', 'Driver')->get();
    return view('driver.driverList', [
        'drivers' => $drivers,
        'section' => 'delivery'
        ]);
}

public function showDriversOnRide()
{
    $driversOnRide = DB::table('orders')
        ->join('delivery', 'orders.id', '=', 'delivery.order_id')
        ->join('employees', 'delivery.driver_id', '=', 'employees.id')
        ->select(
            'orders.id as order_id',
            'orders.created_at as order_created_at',
            'employees.name',
            'employees.nic',
            'employees.phone',
            'employees.address_line1',
            'employees.address_line2',
            'employees.city',
            'employees.postal_code',
            'employees.email'
        )
        ->where('orders.order_status', 'Dispatched')
        ->get();

    $drivers = Employee::where('position', 'Driver')->get();

    return view('driver.driverList', [
        'drivers' => $drivers,
        'driversOnRide' => $driversOnRide,
        'section' => 'delivery'
    ]);
}




public function deliveryHistory()
{
      $deliveries = Delivery::all();
    return view('driver.deliveryHistory', [
        'deliveries' => $deliveries,
        'section' => 'delivery',
    ]);


}





//show all orders with status 'Dispatched' for delivery confirmation
public function showDispatchedOrders()
    {
        // Get all orders with status 'Dispatched'
        $orders = Order::where('order_status', 'Dispatched')->get();

        // Return view with orders data
        return view('driver.deliveryConfirmation', compact('orders'));
    }





    public function markOrderDelivered($orderId)
    {
        // Find the order
        $order = Order::findOrFail($orderId);

        // Update status
        $order->order_status = 'Delivered';
        $order->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Order marked as Delivered.');
    }




public function downloadReport($orderId)
{
    $order = Order::findOrFail($orderId);
    $delivery = Delivery::where('order_id', $orderId)->first();

    // Get the related driver (employee) using the relationship
    $driver = $delivery ? $delivery->driver : null;

    $pdf = Pdf::loadView('driver.allocation-report', compact('order', 'delivery', 'driver'));


    return $pdf->download('driver_allocation_report_order_' . $orderId . '.pdf');
}


}
