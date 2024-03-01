<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\UserSeeder as SeedersUserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(SeedersUserSeeder::class);
        \App\Models\User::factory(5)->create();

        // DB::table('users')->insert([
        //     'name' => 'Newbie Laravel',
        //     'email' => 'minhdanglxag1@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
       
    }
}
