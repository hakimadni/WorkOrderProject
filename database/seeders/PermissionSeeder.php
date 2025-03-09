<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
            // Admin permissions
            ['role_id' => 1, 'menu_id' => 1, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 3, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 4, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 5, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 6, 'can_create' => false, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['role_id' => 1, 'menu_id' => 7, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 8, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 9, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],
            ['role_id' => 1, 'menu_id' => 10, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => true],

            // Production Manager permissions
            ['role_id' => 2, 'menu_id' => 3, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['role_id' => 2, 'menu_id' => 8, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['role_id' => 2, 'menu_id' => 9, 'can_create' => true, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['role_id' => 2, 'menu_id' => 10, 'can_create' => false, 'can_read' => true, 'can_update' => true, 'can_delete' => true],

            // Operator permissions
            ['role_id' => 3, 'menu_id' => 8, 'can_create' => false, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
            ['role_id' => 3, 'menu_id' => 9, 'can_create' => false, 'can_read' => true, 'can_update' => true, 'can_delete' => false],
        ]);
    }
}
