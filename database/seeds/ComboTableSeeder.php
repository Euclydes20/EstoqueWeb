<?php

use Illuminate\Database\Seeder;

class ComboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breadsIDs = DB::table('bread')->select('id')->get();
        $saladsIDs = DB::table('salad')->select('id')->get();
        $proteinsIDs = DB::table('protein')->select('id')->get();

        $faker = Faker\Factory::create("pt_BR");

        for ($i=1; $i <= 100; $i++) {
            DB::table('combo')->insert([                
                'id_bread' => $faker->randomElement($breadsIDs)->id,
                'id_salad' => $faker->randomElement($saladsIDs)->id,
                'id_protein' => $faker->randomElement($proteinsIDs)->id,
                'created_at' => now()
            ]); 
        }
    }
}
