<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Employee;
use App\Models\Delivery;
use App\Models\Driver;

use Illuminate\Support\Facades\DB;


class DriverController extends Controller
{
    // Show orders pending driver allocation
    public function pendingAllocation()
    {
        $orders = Order::where('order_status', 'Waiting for Delivery')->get(); // Or your own logidata:

        return view('driver.pendingAllocation', [
            'orders' => $orders,
            'section' => 'delivery', // or 'customer' based on context
        ]);



    }

      //  $orders = Order::where('order_status', 'Waiting for Delivery')->get();
     //   return view('driver.pendingAllocation', [
           // 'orders' => $orders,
          //  'section' => 'delivery'
  //      ]);


    // Show form to allocate a driver to an order
 /*   public function allocateDriver($order_id)
    {
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
*/

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
        $section = 'delivery'; // or 'customer' based on your logic

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
        ]);

        $delivery = Delivery::firstOrNew(['order_id' => $validated['order_id']]);
        $delivery->fill([
            'driver_id'   => $validated['driver_id'],
            'address'     => $validated['address'],
            'landmark'    => $validated['landmark'],
            'phone'       => $validated['phone'],
            'assigned_to' => Employee::find($validated['driver_id'])->name ?? null,
        ])->save();

        return redirect()
        ->route('driver.allocate', ['order_id' => $validated['order_id']])
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

        return redirect()->route('driver.allocation.details')->with('success', 'Delivery updated successfully.');
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
      // Use 'delivery_id' instead of 'id'
      DB::table('delivery')->where('delivery_id', $delivery_id)->delete();

      return redirect()->route('driver.allocation.details')->with('success', 'Delivery deleted successfully');
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
    // Get deliveries where a driver is assigned
    $driversOnRide = DB::table('delivery')
        ->whereNotNull('assigned_to')  // Ensure that there's a driver assigned
        ->where('assigned_to', '!=', '') // Exclude empty values
        ->select('assigned_to', 'phone', 'address', 'created_at')
        ->get();

    // Pass the $driversOnRide variable to the Blade view
    return view('driver.driverList', compact('driversOnRide'));
}


public function deliveryHistory()
{
      $deliveries = Delivery::all();
    return view('driver.deliveryHistory', [
        'deliveries' => $deliveries,
        'section' => 'delivery',
    ]);


}






}
