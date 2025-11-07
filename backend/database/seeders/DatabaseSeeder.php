<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Blog;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $users = [
            ['name' => 'admin', 'email' => 'ad@min', 'password' => bcrypt('ad')],
            ['name' => 'asd', 'email' => 'asd@asd.com', 'password' => bcrypt('asd')],
            ['name' => 'def', 'email' => 'def@def', 'password' => bcrypt('asd')],
        ];

        foreach($users as $user) {
            User::factory()->create($user);
        }

        $blogs = [
            ['title' => 'README', 'user_id' => 1, 'date' =>'2025-11-07', 'text' => "# Simple fullstack Blog Website\n\n## Stack\n- Frontend: [Vue 3](https://vuejs.org/guide/introduction.html)\n- Backend: [Laravel 12](https://laravel.com/docs/12.x)"],
            ['title' => 'info', 'user_id' => 1, 'date' =>'2025-11-08', 'text' => "## Users:\n| Email         | Password  |\n| :--           | :--       |\n| ad@min        | ad        |\n| def@def       | asd       |\n| asd@asd.com   | asd       |\n\n\n## Run Instructions\n### Linux\n`sh run.sh`\n### Windows\nRun frontend first"],
            ['title' => 'lorem ipsum', 'user_id' => 2, 'date' =>'2025-10-20', 'text' => "# My Lorem Ipsum Example\n\n## Paragraph One: *The Classics*\n\nLorem ipsum dolor sit amet, **consectetur adipiscing elit**. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. *Excepteur sint occaecat cupidatat non proident*, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n## Paragraph Two: Exploring More Options\n\nNunc id cursus metus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris scelerisque est vel metus aliquet, at tincidunt tellus consectetur. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec eleifend dui sit amet lacus maximus, vel euismod ipsum mattis.\n\n### Key Points from this Text:\n\n*   **Timeless Text:** *Lorem ipsum* has been a standard placeholder for centuries.\n*   **Purpose:** It's used to demonstrate visual form without distracting content.\n*   **Variety:** This example includes two distinct paragraphs."],
        ];

        foreach($blogs as $blog) {
            Blog::factory()->create($blog);
        }
    }
}
