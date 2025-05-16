<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in using the 'admin' guard and Employee model
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('status', 'Login successful!');
        } else {
            return redirect()->back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'address' => 'required|string',
            'county' => 'required|string',
            'company_email' => 'required|string|email|unique:company,email',
            'phone' => 'required|string',
            'fax' => 'nullable|string',
            'currency' => 'required|string',
            'username' => 'required|string|unique:tbluser,username',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'address' => $request->address,
            'county' => $request->county,
            'email' => $request->company_email,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'currency' => $request->currency,
        ]);

        DB::insert('INSERT INTO role (role, description) values (?, ?, )', ['owner', 'owner']);
        $roleId = DB::getPdo()->lastInsertId();




        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'pw' => Hash::make($request->password),
            'email' => $request->company_email,
            'mobile' => $request->phone,
            'role' => $roleId,
            'company_id' => $company->id,
        ]);

        return redirect('/login')->with('status', 'Registration successful! You can now login.');
    }

    public function getUserPermissions()
    {
        try {
            $user = Auth::guard('admin')->user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $role = DB::table('role')
                ->where('role', $user->position)
                ->first();

            if (!$role) {
                return response()->json(['error' => 'Role not found'], 404);
            }

            // Get permissions for the role
            $permissions = DB::table('user_per')
                ->where('role', $role->id)
                ->select('inv', 'cus', 'order', 'deli', 'emp', 'acc', 'pro')
                ->first();

            return response()->json($permissions);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function updatePermission(Request $request)
    {
        $role = $request->input('role');
        $permission = $request->input('permission');
        $value = $request->input('value');

        // Validate the permission field
        $validPermissions = ['inv', 'cus', 'order', 'deli', 'emp', 'acc', 'pro'];
        if (!in_array($permission, $validPermissions)) {
            return response()->json(['success' => false, 'message' => 'Invalid permission field'], 400);
        }

        $updated = DB::table('user_per')
            ->where('role', $role)
            ->update([$permission => $value]);

        if ($updated) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
