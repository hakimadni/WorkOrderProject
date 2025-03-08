<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            ['name' => 'Posts', 'route' => 'posts', 'icon' => '<i class="fas fa-file"></i>', 'no_menu' => 1, 'parent_id' => null, 'showed' => 1],
            ['name' => 'Setting', 'route' => null, 'icon' => '<i class="fas fa-wrench"></i>', 'no_menu' => 100, 'parent_id' => null, 'showed' => 1],
            ['name' => 'Manage Users', 'route' => 'users', 'icon' => '<i class="fas fa-users"></i>', 'no_menu' => 1, 'parent_id' => 2, 'showed' => 1],
            ['name' => 'Manage Roles', 'route' => 'roles', 'icon' => '<i class="fas fa-user-shield"></i>', 'no_menu' => 2, 'parent_id' => 2, 'showed' => 1],
            ['name' => 'Manage Menu', 'route' => 'menus', 'icon' => '<i class="fas fa-bars"></i>', 'no_menu' => 3, 'parent_id' => 2, 'showed' => 1,],

            ['name' => 'Profile', 'route' => 'profile.edit', 'icon' => '<i class="fas fa-user"></i>', 'no_menu' => 2, 'parent_id' => null, 'showed' => null],
            ['name' => 'Permission', 'route' => 'permissions', 'icon' => '', 'no_menu' => null, 'parent_id' => null, 'showed' => null],
        ]);
    }
}
