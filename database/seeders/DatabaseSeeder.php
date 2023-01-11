<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory()->create();

        User::factory()->create([
            'type' => 'cc',
            'cc' => '123456789',
            'name' => 'Admin',
            'job' => 'a',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'question' => 'pq',
            'answer' => 'pq zi',
            'password' => Hash::make('123456789'),
            'status' => '1',
        ]);
    }
}
