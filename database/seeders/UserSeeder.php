<?php

namespace Database\Seeders;

use Velocix\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run()
    {
        // Example: Insert sample data
        
        $this->create('users', [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
        

        // Or use faker-like helpers:
        /*
        for ($i = 1; $i <= 10; $i++) {
            $this->insert('posts', [
                'title' => 'Post ' . $i,
                'content' => $this->randomText(50),
                'author_id' => $this->randomNumber(1, 5),
                'created_at' => $this->randomDate('-6 months', 'now'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        */

        echo "Seeded: UserSeeder\n";
    }
}