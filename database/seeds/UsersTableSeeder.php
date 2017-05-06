<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'barb',
            'email' => 'barb@example.com',
            'password' => bcrypt('barb'),
            'subscribed_to_newsletter' => TRUE,
            'third_party_offers' => FALSE,
            'card_name' => 'Barbara Marsh',
            'card_number' => 4242424242424242,
            'expiry' => '2020-06-01',
            'csv' => 123,
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'subscribed_to_newsletter' => FALSE,
            'third_party_offers' => FALSE,
            'admin' => TRUE,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
