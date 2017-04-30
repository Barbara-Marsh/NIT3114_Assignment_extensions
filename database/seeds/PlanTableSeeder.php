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
            'features' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a leo et eros ornare volutpat. Curabitur iaculis, tortor vel interdum lobortis, enim arcu convallis quam, vestibulum commodo lacus leo in nulla. Curabitur et semper urna, sed porttitor est. Nulla ornare vehicula massa sed mattis. Nam ac scelerisque lectus.',
            'price' => 0.00,
            'is_active' => TRUE,
        ]);

        DB::table('plans')->insert([
            'name' => 'Basic',
            'features' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a leo et eros ornare volutpat. Curabitur iaculis, tortor vel interdum lobortis, enim arcu convallis quam, vestibulum commodo lacus leo in nulla. Curabitur et semper urna, sed porttitor est. Nulla ornare vehicula massa sed mattis. Nam ac scelerisque lectus.',
            'price' => 49.95,
            'is_active' => TRUE,
        ]);

        DB::table('plans')->insert([
            'name' => 'Pro',
            'features' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a leo et eros ornare volutpat. Curabitur iaculis, tortor vel interdum lobortis, enim arcu convallis quam, vestibulum commodo lacus leo in nulla. Curabitur et semper urna, sed porttitor est. Nulla ornare vehicula massa sed mattis. Nam ac scelerisque lectus.',
            'price' => 89.95,
            'is_active' => TRUE,
        ]);
    }
}
