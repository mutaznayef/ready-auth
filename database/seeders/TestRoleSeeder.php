<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['auth_code' => 'admin', 'name' => 'Admin']);
        $editor = Role::firstOrCreate(['auth_code' => 'editor', 'name' => 'Editor']);

        // Create permissions
        $edit = Permission::firstOrCreate(['auth_code' => 'edit-posts', 'description' => 'Edit Posts']);
        $delete = Permission::firstOrCreate(['auth_code' => 'delete-posts', 'description' => 'Delete Posts']);

        // Assign permissions to roles
        $admin->permissions()->sync([$edit->id, $delete->id]);
        $editor->permissions()->sync([$edit->id]);

        // Create user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
        ]);

        // Assign role to user
        $user->assignRole('admin');
        $user->givePermissionTo('delete-posts'); // direct permission (optional)
    }
}
