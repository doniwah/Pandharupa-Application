<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $this->call(KelasSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(LibrarySeeder::class);
        $this->call(EventSeeder::class);
        User::factory()->create([
            'name' => 'doni',
            'email' => 'doni@developer.com',
            'password' => bcrypt('password'),
        ]);
    }
}