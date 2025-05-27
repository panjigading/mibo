<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'username' => 'theadmin',
            'display_name' => 'Administrator',
            'password' => Hash::make('securepassword1'),
            'profile_picture' => 'profile_pictures/admin_avatar.jpg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $john = User::create([
            'username' => 'johndoe',
            'display_name' => 'John Doe',
            'password' => Hash::make('simplepass'),
            'profile_picture' => 'profile_pictures/john_profile.png',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sarah = User::create([
            'username' => 'sarah_m',
            'display_name' => 'Sarah Miller',
            'password' => Hash::make('mysecret'),
            'profile_picture' => 'profile_pictures/sarah_image.jpeg',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
