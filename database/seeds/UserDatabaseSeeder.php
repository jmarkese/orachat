<?php

use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSession::truncate();

        // generate a few users for our app:
        factory(App\User::class, 5)->create();
    }
}
