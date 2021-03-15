<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John',
            'username' => 'bl4d3runn3r',
            'password' => Hash::make('cyberpunk'),
            'role' => 'admin'
        ]);
    }
}
