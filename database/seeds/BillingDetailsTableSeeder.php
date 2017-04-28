<?php

use Illuminate\Database\Seeder;

class BillingDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('billing_details')->insert([
            'user_id' => 1,
            'card_name' => 'Barbara Marsh',
            'card_number' => 4242424242424242,
            'expiry' => '2020-06-01',
            'csv' => 123,
        ]);
    }
}
