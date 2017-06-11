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
            'name' => 'Barb',
            'email' => 'barb@example.com',
            'password' => bcrypt('barb'),
            'subscribed_to_newsletter' => TRUE,
            'third_party_offers' => FALSE,
            'stripe_id' => 'cus_AjZs3z1r4D2MjT',
            'created_at' => \Carbon\Carbon::now()->subMonths(6),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'subscribed_to_newsletter' => FALSE,
            'third_party_offers' => FALSE,
            'admin' => TRUE,
            'created_at' => \Carbon\Carbon::now()->subMonths(3),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => bcrypt('john'),
            'subscribed_to_newsletter' => TRUE,
            'third_party_offers' => TRUE,
            'is_banned' => TRUE,
            'stripe_id' => 'cus_AkIjlZQzjU133c',
            'created_at' => \Carbon\Carbon::now()->subMonths(2),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Sally',
            'email' => 'sally@example.com',
            'password' => bcrypt('sally'),
            'subscribed_to_newsletter' => FALSE,
            'third_party_offers' => FALSE,
            'stripe_id' => 'cus_AjqrQJHIeFAkqr',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Joe',
            'email' => 'joe@example.com',
            'password' => bcrypt('joe'),
            'subscribed_to_newsletter' => FALSE,
            'third_party_offers' => TRUE,
            'stripe_id' => 'cus_Aj9klKx1iyeyrY',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
