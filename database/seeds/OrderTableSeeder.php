<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    
    public function run()
    {
        $comboIDs = DB::table('combo')->select('id')->get();

        $faker = Faker\Factory::create("pt_BR");

        for ($i=1; $i <= 100; $i++) {
            DB::table('combo')->insert([                
                'id_combo' => $faker->randomElement($comboIDs)->id,                
                'created_at' => now()
            ]); 
        }
    }
}
