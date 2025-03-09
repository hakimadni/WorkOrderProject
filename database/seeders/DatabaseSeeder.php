<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WorkOrderProgressMaster;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 1, // Assuming 'Admin' role has ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Production Manager',
                'email' => 'pm@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 2, // Assuming 'Admin' role has ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operator 1',
                'email' => 'op1@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 3, // Assuming 'User' role has ID 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operator 2',
                'email' => 'op2@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 3, // Assuming 'User' role has ID 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operator 3',
                'email' => 'op3@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 3, // Assuming 'User' role has ID 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        WorkOrderProgressMaster::insert([
            [
                'name' => 'Pending',
                'step' => 1,
                'description' => 'Work order created',
            ],
            [
                'name' => 'Canceled',
                'step' => 101,
                'description' => 'Work order canceled',
            ],
            [
                'name' => 'In Progress',
                'step' => 2,
                'description' => 'Pemotongan',
            ],
            [
                'name' => 'In Progress',
                'step' => 3,
                'description' => 'Perakitan',
            ],
            [
                'name' => 'Done',
                'step' => 100,
                'description' => 'Work Order Selesai',
            ]
        ]);

        $this->call([
            RoleSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
        ]);

    }

}
