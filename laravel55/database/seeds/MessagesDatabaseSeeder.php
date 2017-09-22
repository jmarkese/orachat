<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();

        // generate a few app messages for our app:
        factory(Message::class, 25)->create();
    }
}
