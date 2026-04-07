<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed user management data
        $this->call([
            UserSeeder::class,
        ]);

        // User::factory(10)->create();

        // Seed CMS data
        $this->call([
            ServiceSeeder::class,
            TimelineSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
