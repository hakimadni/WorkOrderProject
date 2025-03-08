<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user) {
            // Load user permissions into session if not already set
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

            // Retrieve current route name (e.g., users.index -> users)
            $routeName = $request->route()->getName();
            $routeBase = explode('.', $routeName)[0];  // Extract base part of route like "users"

            // Fetch permissions from session
            $permissions = session('user_permissions', []);

            // Check for the permission based on the route base
            $permission = collect($permissions)->firstWhere('route_name', $routeBase);
            // dd($routeBase, $permissions, $permission);
            // If no permission found or all permissions are false
            if ($permission) {
                $canCreate = $permission['can_create'];
                $canRead = $permission['can_read'];
                $canUpdate = $permission['can_update'];
                $canDelete = $permission['can_delete'];

                // Check the specific permission (create, read, update, delete)
                if (
                    ($request->isMethod('POST')
                        && !$canCreate) ||  // Check create
                    ($request->isMethod('GET')
                        && in_array($routeName, [$routeBase . '.index', $routeBase . '.show', $routeBase . '.edit'])
                        && !$canRead) ||  // Check read
                    (($request->isMethod('PUT') || $request->isMethod('PATCH'))
                        && !$canUpdate) ||  // Check update
                    ($request->isMethod('DELETE')
                        && !$canDelete)  // Check delete
                ) {
                    \Log::warning("Unauthorized access to route '{$routeName}' by user ID {$user->id}");
                    return abort(403, 'Unauthorized action.');
                }
            } else {
                \Log::warning("No permission found for route '{$routeName}' by user ID {$user->id}");
                return abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }

}
