<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends TestCase
{
   /*  use WithoutMiddleware;

    public function testUserCreatedSuccessfully()
    {
        $faker = \Faker\Factory::create();
        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $name = $faker->name();
        $username = $faker->userName();
        $password = '1234567890';
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);

        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'status'
            ]);
    }

    public function testNameIsLessThanFour()
    {
        $faker = \Faker\Factory::create();

        $name = '123';
        $username = $faker->username();
        $password = '1234567890';
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testUsernameIsLessThanThree()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name();
        $username = '12';
        $password = '1234567890';
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testNameIsGreaterThanThirty()
    {
        $faker = \Faker\Factory::create();

        $name = 'superlongstringsuperlongstringsuperlongstringsuperlongstring';
        $username = $faker->username();
        $password = '123456789'; 
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testPassswordIsGreaterThanThirty()
    {
        $faker = \Faker\Factory::create();

        $name = '123';
        $username = $faker->username();
        $password = 'superlongpasswordsuperlongpasswordsuperlongpassword';
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testPasswordIsLessThanEight()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name();
        $username = $faker->username();
        $password = '1234567';
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testUsernameIsGreaterThanTwentyFive()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name();
        $username = 'superlongusernamesuperlongusernamesuperlongusernamesuperlongusername';
        $password = $faker->password(); // 45
        $role =  $faker->randomElement(['admin', 'backoffice', 'regular']);
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testIfRoleNotPresent()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name();
        $username = $faker->userName();
        $password = $faker->password(); // 45
        $role = '';
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testIfRoleIsDifferent()
    {
        $faker = \Faker\Factory::create();

        $name = $faker->name();
        $username = $faker->userName();
        $password = $faker->password(); // 45
        $role = 'dummy';
    
        $response = $this->call('POST', 'api/user', [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }

    public function testIfCanShowUsers()
    {
        $response = $this->call('GET', 'api/user')
            ->assertStatus(200)
            ->assertJsonStructure([
                'users'
            ]);
    }
 */}
