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
        DB::table('subscriptions')->insert([
            'user_id' => 1,
            'plan_id' => 2,
            'renew_plan_id' => NULL,
            'price' => 49.95,
            'starts_at' => '2017-05-01',
            'ends_at' => '2017-06-01',
            'status' => 'active',
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 3,
            'plan_id' => 2,
            'renew_plan_id' => NULL,
            'price' => 49.95,
            'starts_at' => '2017-05-23',
            'ends_at' => '2017-06-22',
            'status' => 'active',
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 4,
            'plan_id' => 1,
            'renew_plan_id' => NULL,
            'price' => 0.00,
            'starts_at' => '2017-04-28',
            'ends_at' => '2017-05-27',
            'status' => 'active',
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 5,
            'plan_id' => 3,
            'renew_plan_id' => NULL,
            'price' => 89.95,
            'starts_at' => '2017-05-01',
            'ends_at' => '2017-06-01',
            'status' => 'active',
        ]);
    }
}
