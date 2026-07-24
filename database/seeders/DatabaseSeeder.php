<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ForumCategory;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles (only if they don't exist)
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $counselorRole = Role::firstOrCreate(['name' => 'counselor', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        // Create admin (only if not already existing by email)
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        // Create two counselors
        $counselor1 = User::firstOrCreate(
            ['email' => 'counselor1@example.com'],
            [
                'name' => 'Dr. Smith',
                'password' => bcrypt('password'),
            ]
        );
        $counselor1->assignRole('counselor');

        $counselor2 = User::firstOrCreate(
            ['email' => 'counselor2@example.com'],
            [
                'name' => 'Dr. Lee',
                'password' => bcrypt('password'),
            ]
        );
        $counselor2->assignRole('counselor');

        // Create a normal user
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'John Doe',
                'password' => bcrypt('password'),
            ]
        );
        $user->assignRole('user');

        // Create categories (only if slug doesn't exist)
        $categories = [
            ['name' => 'Anxiety', 'slug' => 'anxiety'],
            ['name' => 'Depression', 'slug' => 'depression'],
            ['name' => 'Relationships', 'slug' => 'relationships'],
            ['name' => 'Stress Management', 'slug' => 'stress-management'],
        ];

        foreach ($categories as $cat) {
            ForumCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}