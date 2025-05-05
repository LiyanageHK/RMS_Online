<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'nic' => 'required|string|max:255|unique:employees',
            'position' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'nic' => $request->nic,
            'position' => $request->position,
            'phone' => $request->phone,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'nic' => 'required|string|max:255|unique:employees,nic,' . $employee->id,
            'position' => 'required|string|max:255',
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

        $employee->update($request->except('password'));

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

        return redirect()->route('employees.show', $employee)
            ->with('success', 'Password changed successfully');
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

        return redirect()->route('employees.profile')
            ->with('success', 'Profile updated successfully');
    }
} 