<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class MessageTest extends TestCase
{
    use WithoutMiddleware;

   /*  public function testIfCanShowMessages()
    {
        $this->call('GET', 'api/message')
            ->assertStatus(200)
            ->assertJsonStructure([
                'messages',
                'status'
            ]);
    }

    public function testIfMessagesAreEmpty()
    {
        $this->call('GET', 'api/message')
        ->assertStatus(404)
        ->assertJsonStructure([
            'error'
        ]); 
    }

    public function testSuccessfullStoredMessage()
    {
        $faker = \Faker\Factory::create();

        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $subject = $faker->sentence(6);
        $content = $faker->sentence(5);
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now'); // '1979-06-09'
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date); // '1979-06-09'

        $response =$this->call('POST', 'api/message', [
            'subject' => $subject,
            'content' => $content,
            'start_date' => $start_date,
            'expiration_date' => $expiration_date
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'status'
            ]);
    }

    public function testUnsuccessfulllStoredMessage()
    {
        $faker = \Faker\Factory::create();

        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $subject = $faker->sentence(3);
        $content = $faker->sentence(100); // content is greater than the limit which in case is 150
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now'); // '1979-06-09'
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date); // '1979-06-09'

        $response =$this->call('POST', 'api/message', [
            'subject' => $subject,
            'content' => $content,
            'start_date' => $start_date,
            'expiration_date' => $expiration_date
        ])
            ->assertStatus(401)
            ->assertJsonStructure([
                'errors'
            ]);
    }
     */

    /* public function testMessageDoesExists()
    {
        $faker = \Faker\Factory::create();
        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $created_by = 'dummy';
        $subject = $faker->sentence(2);
        $content = $faker->sentence(10);
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now');
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date);
        $user_id = '21';

        $messageData = [
            'created_by' => 'dummy',
            'subject' => $faker->sentence(2),
            'content' => $faker->sentence(10),
            'start_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
            'expiration_date' => $faker->date($format = 'Y-m-d', $min = $start_date),
            'user_id' => $user_id
        ];

        $message = Message::factory()->create($messageData);


        $response = $this->call('GET', 'api/message/' . $message->id, [
            'created_by' => $created_by,
            'subject' => $subject,
            'content' => $content,
            'start_date' => $start_date,
            'expiration_date' => $expiration_date,
            'user_id' => $user_id
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'status'
            ]);
    } 
    
    public function testDeleteMessage()
    {
        $faker = \Faker\Factory::create();
        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $created_by = 'dummy';
        $subject = $faker->sentence(2);
        $content = $faker->sentence(10);
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now');
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date);
        $user_id = '21';

        $messageData = [
            'created_by' => 'dummy',
            'subject' => $faker->sentence(2),
            'content' => $faker->sentence(10),
            'start_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
            'expiration_date' => $faker->date($format = 'Y-m-d', $min = $start_date),
            'user_id' => $user_id
        ];

        $message = Message::factory()->create($messageData);


        $response = $this->call('DELETE', 'api/message/' . $message->id, [])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status'
            ]); 
    }
*/

    public function testUpdateMessage()
    {
        $faker = \Faker\Factory::create();
        $loggedUser = User::factory()->create();
        
        $this->actingAs($loggedUser, 'api');

        $created_by = 'dummy';
        $subject = $faker->sentence(2);
        $content = $faker->sentence(10);
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now');
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date);
        $user_id = '21';

        $messageData = [
            'created_by' => 'dummy',
            'subject' => $faker->sentence(2),
            'content' => $faker->sentence(10),
            'start_date' => $faker->date($format = 'Y-m-d', $min = 'now'),
            'expiration_date' => $faker->date($format = 'Y-m-d', $min = $start_date),
            'user_id' => $user_id
        ];

        $message = Message::factory()->create($messageData);


        $created_by = 'Another Dummy';
        $subject = 'Updated Subject';
        $content = 'Updated Content';
        $start_date = $faker->date($format = 'Y-m-d', $min = 'now');
        $expiration_date = $faker->date($format = 'Y-m-d', $min = $start_date);
        $user_id = '30';

        $response = $this->call('PUT', 'api/message/' . $message->id, [
            'created_by' => $created_by,
            'subject' => $subject,
            'content' => $content,
            'start_date' => $start_date,
            'expiration_date' => $expiration_date,
            'user_id' => $user_id
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status'
            ]);
    }
}
