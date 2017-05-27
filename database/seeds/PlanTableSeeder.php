<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name' => 'Open',
            'features' => 'Data for one Australian capital city.',
            'price' => 0,
            'number_of_cities' => 1,
            'is_active' => TRUE,
            'stripe_id' => 'open',
        ]);

        DB::table('plans')->insert([
            'name' => 'Basic',
            'features' => 'Data for three Australian capital cities.',
            'price' => 995,
            'number_of_cities' => 3,
            'is_active' => TRUE,
            'stripe_id' => 'basic',
        ]);

        DB::table('plans')->insert([
            'name' => 'Pro',
            'features' => 'Data for all Australian capital cities.',
            'price' => 1995,
            'number_of_cities' => 8,
            'is_active' => TRUE,
            'stripe_id' => 'pro',
        ]);
    }
}
