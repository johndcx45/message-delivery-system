<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(2),
            'content' => $this->faker->sentence(10),
            'start_date' => $this->faker->date($format = 'Y-m-d', $min = 'now'),
            'expiration_date' => $this->faker->date($format = 'Y-m-d', $min = 'now')
        ];
    }
}
