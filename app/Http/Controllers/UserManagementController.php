<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class UserManagementController extends Controller
{
    public function index()
    {
        $usersQ = User::query();  // Start with a query builder instance
        $rolesQ = Role::query();
        if (auth()->user()->role_id > 1) {
            $usersQ->where('id', '>', 1);  // Add condition based on role
            $rolesQ->where('id', '>', 1);  // Add condition based on role
        }
        $users = $usersQ->get();
        $roles = $rolesQ->get();

        return view('admin.users.index', compact(['users', 'roles']));
    }
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed', // You can also use 'password_confirmation'
                'role_id' => 'required|exists:roles,id',  // Ensure role exists in the database
            ]);

            // Create the new user
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role_id' => $request->input('role_id'),
            ]);

            // Redirect with success status
            return redirect()->route('users.index')->with('status', 'User created successfully.');
        } catch (\Exception $e) {
            // If an error occurs, log the error and return a failure status
            \Log::error('Error creating user: ' . $e->getMessage());

            // Redirect with error status
            return redirect()->route('users.index')->with('error', 'There was an error creating the user.');
        }
    }


    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        Session::forget('user_permissions');
        // Update the user's role
        $user->role_id = $request->input('role_id');
        $user->save();
        $userManagement = new PermissionController();
        $userManagement->assignUserPermissions($user);
        // Redirect back with success message
        return redirect()->back()->with('status', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return redirect()->back()->with(['status' => 'User deleted successfully']);

    }
}
