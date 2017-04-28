<?php

use Illuminate\Database\Seeder;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription')->insert([
            'user_id' => 1,
            'plan_id' => 2,
            'starts_at' => '2017-03-01',
            'ends_at' => '2017-06-01',
            'status' => 'active',
        ]);
    }
}
