<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create admin role
        $adminRole = Role::create(['name' => 'admin']);

        // Create student role
        $studentRole = Role::create(['name' => 'student']);

        // Create permissions
        $permissions = [
            'approve posts',
            'reject posts',
            'approve events',
            'reject events',
            'approve users',
            'reject users',
            'manage forums',
            'manage threads',
            'manage comments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('admin');

        // Create some demo students
        $student1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);

        $student1->assignRole('student');

        $student2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'status' => 'pending',
            'email_verified_at' => now(),
        ]);

        $student2->assignRole('student');
    }
}
