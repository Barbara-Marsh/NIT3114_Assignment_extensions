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
        DB::table('invoices')->insert([
            'subscription_id' => 1,
            'price' => 49.95,
            'date' => '2017-03-01',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 1,
            'price' => 49.95,
            'date' => '2017-04-01',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 1,
            'price' => 49.95,
            'date' => '2017-05-01',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 2,
            'price' => 49.95,
            'discount' => 10.00,
            'date' => '2017-04-28',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 2,
            'price' => 49.95,
            'discount' => 10.00,
            'date' => '2017-05-28',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 3,
            'price' => 0.00,
            'date' => '2017-04-28',
            'ignore_taxes' => FALSE,
        ]);

        DB::table('invoices')->insert([
            'subscription_id' => 4,
            'price' => 89.95,
            'date' => '2017-05-01',
            'ignore_taxes' => FALSE,
        ]);
    }
}
