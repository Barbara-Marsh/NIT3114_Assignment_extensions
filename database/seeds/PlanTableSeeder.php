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
        DB::table('plan')->insert([
            'name' => 'Open',
            'features' => '',
            'price' => 0.00,
            'is_active' => TRUE,
        ]);

        DB::table('plan')->insert([
            'name' => 'Basic',
            'features' => '',
            'price' => 49.95,
            'is_active' => TRUE,
        ]);

        DB::table('plan')->insert([
            'name' => 'Pro',
            'features' => '',
            'price' => 89.95,
            'is_active' => TRUE,
        ]);
    }
}
