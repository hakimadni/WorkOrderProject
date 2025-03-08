<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuManagementController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('no_menu')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'no_menu' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $menu = Menu::create($validatedData);

        return response()->json([
            'message' => 'Menu created successfully',
            'menu' => $menu,
        ]);
    }
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'no_menu' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $menu->update($validatedData);

        return response()->json([
            'message' => 'Menu updated successfully',
            'menu' => $menu,
        ]);
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
