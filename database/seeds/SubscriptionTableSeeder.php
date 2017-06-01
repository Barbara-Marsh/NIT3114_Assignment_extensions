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
            'name' => 'Basic',
            'stripe_id' => 'sub_AjZsDRijPfo1mL',
            'stripe_plan' => 'basic',
            'quantity' => 1,
            'active' => TRUE,
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 3,
            'name' => 'Basic',
            'stripe_id' => 'sub_AkIj651PPJwh9I',
            'stripe_plan' => 'basic',
            'quantity' => 1,
            'created_at' => '2017-05-29 13:42:10',
            'updated_at' => '2017-05-29 13:42:10',
            'active' => TRUE,
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 4,
            'name' => 'Pro',
            'stripe_id' => 'sub_AjqrXFXwCpkrfx',
            'stripe_plan' => 'pro',
            'quantity' => 1,
            'active' => TRUE,
        ]);

        DB::table('subscriptions')->insert([
            'user_id' => 5,
            'name' => 'Open',
            'stripe_id' => 'sub_Aj9kcwk8Vutqzf',
            'stripe_plan' => 'open',
            'quantity' => 1,
            'active' => TRUE,
        ]);
    }
}
