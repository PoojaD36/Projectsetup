<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::upsert([
            [
                'name' => 'Admin',
                'email' => 'admin@yopmail.com',
                'password' => Hash::make('admin@123'),
                'user_type' => '1'
            ]
        ], ['email'], ['name', 'password', 'user_type']);
    }
}
