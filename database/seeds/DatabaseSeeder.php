<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
    }
}
