<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        /*User::create([
            'name' => 'Johnny Test',
            'username' => 'bl4d3runn3r',
            'password' => Hash::make('cyberpunk'),
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'Marty',
            'username' => 'mcfly',
            'password' => Hash::make('future'),
            'role' => 'backoffice'
        ]);
        
        User::create([
            'name' => 'Vincent',
            'username' => 'nameisv',
            'password' => Hash::make('2077'),
            'role' => 'backoffice'
        ]);
        */
        User::create([
            'name' => 'Khada Jhin',
            'username' => 'fashionist',
            'password' => Hash::make('1234'),
            'role' => 'backoffice'
        ]);
    }
}
