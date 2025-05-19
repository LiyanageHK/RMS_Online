<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('id', 'like', '%' . $searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            });
        }

        $employees = $query->orderBy('id')->paginate(10);  // Added pagination for better performance

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        $roles = \DB::table('role')->get();
        return view('employees.create', compact('roles')); // Pass roles to the view
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'unique:employees,email',
        ],
        'nic' => 'required|string|max:255|unique:employees',
        'position' => 'required|exists:role,role',
        'phone' => 'nullable|string|max:255',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'nic' => $request->nic,
        'position' => $request->position,
        'phone' => $request->phone,
        'address_line1' => $request->address_line1,
        'address_line2' => $request->address_line2,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
        'password' => Hash::make($request->nic), // default password is NIC
    ]);

    return redirect()->route('employees.index')
        ->with('success', 'Employee created successfully.');
}

    /**
     * Display the specified employee.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        
        return view('employees.edit', compact('employee')); // Pass roles to the view
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'unique:employees,email,' . $employee->id,
            ],
            'nic' => 'required|string|max:255|unique:employees,nic,' . $employee->id,
            'position' => 'required|exists:role,role',
            'phone' => 'nullable|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

$employee->update([
    'name' => $request->name,
    'email' => $request->email,
    'nic' => $request->nic,
    'position' => $request->position, // Store role name
    'phone' => $request->phone,
    'address_line1' => $request->address_line1,
    'address_line2' => $request->address_line2,
    'city' => $request->city,
    'postal_code' => $request->postal_code,
]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }

    /**
     * Show the form for changing password.
     */
    public function showChangePasswordForm()
    {
        return view('employees.change-password');
    }

    /**
     * Change the employee's password.
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $employee = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $employee->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $employee->password = Hash::make($request->new_password);
        $employee->save();

        // Log out the user after password change
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Password changed successfully. Please log in with your new password.');
    }

    /**
     * Show the employee's profile.
     */
    public function profile()
    {
        $employee = Auth::user();
        return view('employees.profile', compact('employee'));
    }

    /**
     * Update the employee's profile.
     */
    public function updateProfile(Request $request)
    {
        $employee = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $employee->update($request->all());

        return redirect()->route('home')->with('success', 'Profile updated successfully');
    }
}
