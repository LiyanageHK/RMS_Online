<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function create()
    {
        return view('admin.role.create');
    }


    public function store(Request $request)
    {
      
        $request->validate([
            'role' => 'required|max:255',
            'description' => 'nullable',
        ]);

        DB::insert('INSERT INTO role (role, description) VALUES (?,?)', [
            strtolower($request->input('role')),
            $request->input('description'),
        ]);
        $role_id = DB::getPdo()->lastInsertId();
        DB::insert('INSERT INTO user_per(role) VALUES(?)', [$role_id]);

        return redirect()->route('admin.role.index')->with('success', 'Role created successfully!');
    }


    public function edit($id)
    {
        $role = DB::select('SELECT * FROM role WHERE id = ?', [$id]);
        $permissions = DB::select('SELECT * FROM user_per WHERE role = ?', [$id]);
        return view('admin.role.edit', ['role' => $role[0], 'permissions' => $permissions[0]]);
    }

    // Update the role in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|max:255',
            'description' => 'nullable',
        ]);
    
        try {
            DB::beginTransaction();
    
            // Update role information
            DB::update('UPDATE role SET role = ?, description = ? WHERE id = ?', [
                strtolower($request->input('role')),
                $request->input('description'),
                $id,
            ]);
    
            // Prepare permissions data
            $permissions = [
                'inv' => $request->has('inv') ? '1' : '0',
                'cus' => $request->has('cus') ? '1' : '0',
                'order' => $request->has('order') ? '1' : '0',
                'deli' => $request->has('deli') ? '1' : '0',
                'emp' => $request->has('emp') ? '1' : '0',
                'acc' => $request->has('acc') ? '1' : '0',
                'pro' => $request->has('pro') ? '1' : '0',
            ];
    
            // Update permissions
            DB::update('UPDATE user_per SET 
                inv = ?, 
                cus = ?, 
                `order` = ?, 
                deli = ?, 
                emp = ?, 
                acc = ?, 
                pro = ? 
                WHERE role = ?', [
                $permissions['inv'],
                $permissions['cus'],
                $permissions['order'],
                $permissions['deli'],
                $permissions['emp'],
                $permissions['acc'],
                $permissions['pro'],
                $id
            ]);
    
            DB::commit();
    
            return redirect()->route('admin.role.index')->with('success', 'Role updated successfully!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update role and permissions: ' . $e->getMessage()
            ], 500);
        }
    }
    // Delete the role from the database
    public function destroy($id)
    {
        DB::delete('DELETE FROM role WHERE id = ?', [$id]);

        return redirect()->route('admin.role.index')->with('success', 'Role deleted successfully!');
    }
    public function index()
    {
     

        $roles = DB::select('SELECT * FROM role' );
        return view('admin.role.index', ['roles' => $roles]);
    }




}