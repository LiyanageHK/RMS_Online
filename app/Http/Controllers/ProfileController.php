<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{


public function show()
{
    $user = auth()->user();

    $orders = Order::where('user_id', $user->id)
                    ->with('items')
                    ->orderBy('created_at', 'desc')
                    ->get();


    return view('profile', compact('user', 'orders'));
}


public function orders()
{
    $user = auth()->user();

    $orders = Order::where('user_id', $user->id)
                    ->with('items')
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('orders', compact('orders'));
}




public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',user_id',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Password confirmation field should be present
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user information
        $user->save();

        // Redirect back with success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');


    }

    public function showLoyaltyProgram()
{
    $users = User::all(); // or your custom query with loyalty filter
    return view('customer.loyalty_program', [
        'section' => 'customer',
        'users' => $users,
    ]);
}


//change customer password

public function changePassword(Request $request, $user_id)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).+$/'],
    ]);

    $user = User::findOrFail($user_id);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password updated successfully.');
}












}

