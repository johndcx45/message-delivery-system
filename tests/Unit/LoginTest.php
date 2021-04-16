<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
   
   public function testSuccessfulLoginAttempt()
    {
        $faker = \Faker\Factory::create();

        $username = $faker->userName();
        $password = $faker->password();

        $credentials = [
            'username' => $username,
            'password' => Hash::make($password)
        ];
        
        $user = User::factory()->create($credentials);

        $response = $this->call('POST', 'api/login', [
            'username' => $username,
            'password' => $password
        ])
            ->assertStatus(200)
            ->assertJsonStructure(['token', 'role']);
    }

    public function testUnsuccessfullLoginAttempt()
    {
        $faker = \Faker\Factory::create();

        $username = $faker->userName();
        $password = $faker->password();

        $credentials = [
            'username' => $username,
            'password' => Hash::make($password)
        ];

        $user = User::factory()->create($credentials);

        $response = $this->call('POST', 'api/login', [
            'username' => $username,
            'password' => 'wrongpassword'
        ])
            ->assertStatus(401)
            ->assertJsonStructure(['message']);
    }

    public function testUsernameAndPasswordAreRequired() 
    {
        $loginData = [
            'username' => '',
            'password' => ''
        ];

        $this->call('POST', 'api/login', $loginData)
            ->assertStatus(400)
            ->assertJsonStructure([
                'errors'
            ]);
    }
    
    public function testPasswordIsLessThanEightCharacters()
    {
        $faker = \Faker\Factory::create();

        $username = $faker->userName();
        $password = '1234567';

        $loginData = [
            'username' =>  $username,
            'password' => Hash::make($password)
        ];  
        
        $this->call('POST', 'api/login', $loginData)
            ->assertStatus(400)
            ->assertJsonStructure([
                'errors'
            ]);
    }
}
