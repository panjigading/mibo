<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('username', 'theadmin')->first();
        $john = User::where('username', 'johndoe')->first();
        $sarah = User::where('username', 'sarah_m')->first();
        
        Post::create([
            'user_id' => $admin->id,
            'title' => 'First Announcement from the Admin',
            'body' => "Hello everyone! Just wanted to let you know about some upcoming changes to the platform. We're working hard to improve your experience. Stay tuned for more updates!",
            'created_at' => now()->subWeek()
        ]);

        for ($i=0; $i < 1; $i++) { 
            Post::create([
                'user_id' => $john-> id,
                'title' => fake()->sentence(3),
                'body' => fake()->text(),
                'created_at' => now()->subDays(5)->subHours($i)
            ]);
        }

        Post::create([
            'user_id' => $admin->id,
            'title' => 'Maintenance Scheduled',
            'body' => "Please be advised that we will be performing scheduled maintenance on the site tomorrow from 2 AM to 4 AM EST. Some features may be temporarily unavailable. Thank you for your patience.",
            'created_at' => now()->subHour(1)
        ]);

        Post::create([
            'user_id' => $sarah->id,
            'title' => fake()->sentence(3),
            'body' => fake()->text(),
            'created_at' => now()
        ]);

    }
}
