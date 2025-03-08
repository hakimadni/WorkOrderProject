<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function update(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        // Check if the logged-in user has role_id > 1 and the same role as the one they're editing
        if (auth()->user()->role_id > 1 && auth()->user()->role_id == $role->id) {
            // If so, prevent updates and return a response indicating permissions are not allowed to be updated
            return response()->json(['message' => 'You are not allowed to update these permissions.'], 403);
        }

        $newPermissions = $request->input('permissions', []);

        foreach ($newPermissions as $permission) {
            $role->permissions()->updateOrCreate(
                ['menu_id' => $permission['menu_id']],
                [$permission['action'] => $permission['value']]
            );
        }

        return response()->json(['message' => 'Permissions updated successfully']);
    }

    public function assignUserPermissions($user)
    {
        if (!session('user_permissions')) {
            $permissions = $user->role
                ->permissions
                ->map(function ($permission) {
                    return [
                        'role_name' => $permission->role->name,
                        'menu_name' => $permission->menu->name,
                        'menu_id' => $permission->menu_id,
                        'can_create' => $permission->can_create == 1,
                        'can_read' => $permission->can_read == 1,
                        'can_update' => $permission->can_update == 1,
                        'can_delete' => $permission->can_delete == 1,
                        'route_name' => $permission->menu->route,
                    ];
                });
            session(['user_permissions' => $permissions]);
        }
    }

}
