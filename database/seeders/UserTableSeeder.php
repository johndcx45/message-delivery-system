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
            'name' => 'Vincent',
            'username' => 'def4lt',
            'password' => Hash::make('deadsec'),
            'role' => 'regular'
        ]);
    }
}
