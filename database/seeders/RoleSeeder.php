<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role =    Role::create(['auth_code' => 'admin', 'name' => 'System Administrator']);
        $role->givePermissionTo('user:create');
    }
}
