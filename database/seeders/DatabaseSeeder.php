<?php

namespace Database\Seeders;

use Velocix\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run()
    {
        // Call other seeders here
         $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(PostSeeder::class);

        echo "Database seeding completed!\n";
    }
}