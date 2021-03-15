<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'created_by' => 'John',
            'subject' => 'New Project started',
            'content' => 'This project will use new technologies and will adopt cloud migration',
            'start_date' => '03/15/2021 14:30',
            'expiration_date' => '03/20/2021 14:30',
            'viewed_by' => 'Ana Clarice',
            'read_by_all' => false,
            'created_at' => '03/15/2021 07:30',
            'user_id' => '1'
        ]);
    }
}
