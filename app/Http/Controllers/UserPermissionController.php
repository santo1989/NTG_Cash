<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index()
    {
        $users = User::all();
        $permissions = Permission::all();

        return view('backend.userpermissions.index', compact('users', 'permissions'));
    }

    /**
     * Store a newly assigned permission for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        // Assign the permission to the user
        $user = User::findOrFail($request->user_id);
        $user->permissions()->attach($request->permission_id);

        return redirect()->route('user_permissions.index')->with('success', 'Permission assigned successfully.');
    }

    /**
     * Remove the specified permission from the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        // Remove the permission from the user
        $user = User::findOrFail($request->user_id);
        $user->permissions()->detach($request->permission_id);

        return redirect()->route('user_permissions.index')->with('success', 'Permission revoked successfully.');
    }
}
