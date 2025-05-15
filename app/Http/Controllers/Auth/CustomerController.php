<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Reward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
            $q->where('user_id', 'like', "%{$search}%")
              ->orWhere('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%")
              ->orWhere('profile_image', 'like', "%{$search}%")
              ->orWhere('email_verified_at', 'like', "%{$search}%")
              ->orWhere('created_at', 'like', "%{$search}%")
              ->orWhere('updated_at', 'like', "%{$search}%");
        });
        }

        $users = $query->orderBy('user_id', 'desc')->get();

        // Define the $section variable
        $section = 'customer'; // Or set it dynamically based on the context

        return view('customer.cusOverview', compact('users', 'section'));


    }


    public function create()
    {
        // Return the create customer view
        return view('customer.create',['section' => 'customer']);
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:10', // 10 digits
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload for profile image
        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // Hash the password before storing it
        $validated['password'] = Hash::make($validated['password']);

        // Create the new customer
        User::create($validated);

        // Redirect with success message
        return redirect()->route('customer.overview')->with('success', 'Customer added successfully.');
    }

    public function edit($userid)
    {
        // Fetch the user to be edited
        $user = User::findOrFail($userid);
        $section = 'Customer';
        return view('customer.edit', compact('user','section'));
    }

    public function update(Request $request, $userid)
    {
        // Find the user by ID
        $user = User::findOrFail($userid);

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userid . ',user_id',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|string|min:6|confirmed', // Password is optional
        ]);

        // Handle profile image upload if a new one is provided
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            // Store the new profile image
            $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        // If a password is provided, hash and update it
        if ($request->password) {
            $validated['password'] = Hash::make($request->password); // Hash the new password
        } else {
            // If no password is provided, keep the old password intact
            unset($validated['password']);
        }

        // Update the user with the validated data
        $user->update($validated);

        // Redirect back to the customer overview with a success message
        return redirect()->route('customer.overview')->with('success', 'Customer updated.');
    }


    public function show($userid)
    {
        // Get customer details
        $user = User::findOrFail($userid);

        // Get orders related to the customer
        $orders = Order::where('user_id', $userid)->get();

        // Define section value (adjust it to fit your logic)
        $section = 'customer';

        // Return view with customer details and orders
        return view('customer.show', compact('user', 'orders','section'));
    }
    public function destroy($id)
    {
        // Find the user to delete
        $user = User::findOrFail($id);

        // Delete the profile image if it exists
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Delete the user record
        $user->delete();

        // Redirect back to the customer overview with a success message
        return redirect()->route('customer.overview')->with('success', 'Customer deleted.');
    }





 public function showLoyaltyProgram()
    {






    $loyalCustomers = DB::table('loyalty_customers')
        ->leftJoin('orders', 'loyalty_customers.user_id', '=', 'orders.user_id')
        ->select(
            'loyalty_customers.user_id',
            'loyalty_customers.name',
            'loyalty_customers.email',
            'loyalty_customers.phone',
            'loyalty_customers.loyalty_level',
            DB::raw('COUNT(orders.id) as orders_count')
        )
        ->groupBy(
            'loyalty_customers.user_id',
            'loyalty_customers.name',
            'loyalty_customers.email',
            'loyalty_customers.phone',
            'loyalty_customers.loyalty_level'
        )
        ->get();

    $section = 'loyalty';

    return view('customer.loyalty_program', compact('loyalCustomers', 'section'));



    }







public function insertLoyalCustomers()
{
    // Get all customers who placed 3 or more orders
    $loyalCustomers = DB::table('users')
        ->join('orders', 'users.user_id', '=', 'orders.user_id')
        ->select(
            'users.user_id',
            'users.name',
            'users.email',
            'users.phone',
            DB::raw('COUNT(orders.id) as order_count')
        )
        ->groupBy('users.user_id', 'users.name', 'users.email', 'users.phone')
        ->having('order_count', '>=', 3)
        ->get();

    foreach ($loyalCustomers as $customer) {
        // Determine loyalty level
        $level = 'Silver';
        if ($customer->order_count >= 10) {
            $level = 'Platinum';
        } elseif ($customer->order_count >= 5) {
            $level = 'Gold';
        }

        // Insert or update in loyalty_customers
        DB::table('loyalty_customers')->updateOrInsert(
            ['user_id' => $customer->user_id],
            [
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'loyalty_level' => $level
            ]
        );
    }

    return redirect()->back()->with('success', 'Loyal customers with correct loyalty levels inserted or updated.');
}























    }









