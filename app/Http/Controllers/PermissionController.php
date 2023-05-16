<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();

        return view('backend.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('backend.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index');
    }

    public function edit(Permission $role)
    {
        return view('backend.permissions.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Permission $role)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $role)
    {
        $role->delete();

        return redirect()->route('permissions.index');
    }
}
