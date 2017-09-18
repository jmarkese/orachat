<?php

use Illuminate\Database\Seeder;
use App\AppMessage;

class TestMessagesDatabaseSeeder extends Seeder
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
        for ($i = 0; $i < 15; $i++) {
            AppMessage::create([
                'message' => $faker->sentence
            ]);
        }
    }
}
