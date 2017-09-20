<?php

use Illuminate\Database\Seeder;
use App\AppMessage;

class AppMessagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppMessage::truncate();
        $faker = \Faker\Factory::create();

        // generate a few app messages for our app:
        factory(\App\Message::class, 25)->create();
    }
}
