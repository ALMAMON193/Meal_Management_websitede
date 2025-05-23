<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('12345678'),
            'role' => 'manager',
        ]);
        User::create([
            'name' => 'Jane Doe',
            'email' => 'user2@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);
    }
}
