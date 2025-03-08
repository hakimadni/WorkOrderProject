<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 1, // Assuming 'Admin' role has ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff User',
                'email' => 'staff@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 2, // Assuming 'Admin' role has ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@hakeemu.com',
                'password' => Hash::make('123123123'),
                'role_id' => 3, // Assuming 'User' role has ID 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->call([
            RoleSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
        ]);

    }

}
