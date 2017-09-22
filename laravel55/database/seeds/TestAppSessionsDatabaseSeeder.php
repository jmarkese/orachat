<?php

use Illuminate\Database\Seeder;
use App\AppSession;

class TestAppSessionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSession::truncate();

        // generate a few app sessions for our app:
        for ($i = 0; $i < 5; $i++) {
            AppSession::create();
        }
    }
}
