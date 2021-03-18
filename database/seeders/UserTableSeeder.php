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
            'name' => 'Booker',
            'username' => 'infinitY',
            'password' => Hash::make('bioshock'),
            'role' => 'backoffice'
        ]);
    }
}
