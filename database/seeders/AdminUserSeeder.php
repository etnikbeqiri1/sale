<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $permission = Permission::create(['name' => 'manage everything']);
        $permission->assignRole($adminRole);

        $adminUser = User::factory()->create([
            'email' => 'etnik@brain.al',
            'password' => bcrypt('Etnik1122.')
        ]);
        $adminUser->assignRole('Administrator');
    }
}
