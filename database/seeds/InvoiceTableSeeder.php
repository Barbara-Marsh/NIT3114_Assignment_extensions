<?php

use Illuminate\Database\Seeder;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice')->insert([
            'subscription_id' => 1,
            'price' => 49.95,
            'date' => '2017-03-01',
            'ignore_taxes' => FALSE,
        ]);
    }
}
