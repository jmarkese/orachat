<?php

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TestAppSessionsDatabaseSeeder::class);
        $this->call(TestAppMessagesDatabaseSeeder::class);
    }
}
