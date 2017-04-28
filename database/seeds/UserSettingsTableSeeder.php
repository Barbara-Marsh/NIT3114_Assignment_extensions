<?php

use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_settings')->insert([
            'user_id' => 1,
            'subscribed_to_newsletter' => TRUE,
            'third_party_offers' => FALSE,
        ]);
    }
}
