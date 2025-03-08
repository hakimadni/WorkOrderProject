<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index()
    {
        $rolesQuery = Role::with('permissions.menu');
        if (auth()->user()->role_id > 1) {
            $rolesQuery->where('id', '>', 1);
        }
        $roles = $rolesQuery->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::with(['permissions.menu', 'users'])->find($id); // Fetch the role with permissions, menus, and associated users
        $menus = Menu::orderBy('no_menu')->get(); // Fetch all menus ordered by 'no_menu'
        $noneRoleUsers = User::whereNot('role_id', $id)->get(); // Fetch users not associated with this role
        $userCount = $role->users->count(); // Count users directly from the relationship

        // Map permissions for easier handling in the view
        $permissions = $role->permissions->mapWithKeys(function ($permission) {
            return [
                $permission->menu_id => [
                    'can_create' => $permission->can_create,
                    'can_read' => $permission->can_read,
                    'can_update' => $permission->can_update,
                    'can_delete' => $permission->can_delete,
                ]
            ];
        });

        return view('admin.roles.edit', compact('role', 'menus', 'permissions', 'noneRoleUsers', 'userCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Role::create([
            'name' => $request->input('name'),
        ]);

        return back()->with('status', 'Role created successfully.');
    }

}
