<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PostsTableSeeder::class);
//         \App\Models\User::factory(10)->create();
    }
}
