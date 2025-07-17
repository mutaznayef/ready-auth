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
            ['auth_code' => 'user:create', 'description' => 'Create user'],
            ['auth_code' => 'permission:create', 'description' => 'Create permission'],
        ]);
    }
}
