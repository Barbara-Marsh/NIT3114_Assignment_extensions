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
            'is_active' => TRUE,
            'stripe_id' => 0,
        ]);

        DB::table('plans')->insert([
            'name' => 'Basic',
            'features' => 'Data for three Australian capital cities.',
            'price' => 995,
            'is_active' => TRUE,
            'stripe_id' => 1,
        ]);

        DB::table('plans')->insert([
            'name' => 'Pro',
            'features' => 'Data for all Australian capital cities.',
            'price' => 1995,
            'is_active' => TRUE,
            'stripe_id' => 2,
        ]);
    }
}
