<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Melbourne',
            'openweathermap_id' => '2158177',
        ]);

        DB::table('cities')->insert([
            'name' => 'Sydney',
            'openweathermap_id' => '2147714',
        ]);

        DB::table('cities')->insert([
            'name' => 'Canberra',
            'openweathermap_id' => '2172517',
        ]);

        DB::table('cities')->insert([
            'name' => 'Brisbane',
            'openweathermap_id' => '2174003',
        ]);

        DB::table('cities')->insert([
            'name' => 'Adelaide',
            'openweathermap_id' => '2078025',
        ]);

        DB::table('cities')->insert([
            'name' => 'Perth',
            'openweathermap_id' => '2063523',
        ]);

        DB::table('cities')->insert([
            'name' => 'Darwin',
            'openweathermap_id' => '2073124',
        ]);

        DB::table('cities')->insert([
            'name' => 'Hobart',
            'openweathermap_id' => '2163355',
        ]);

    }
}
