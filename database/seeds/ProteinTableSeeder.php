<?php

use Illuminate\Database\Seeder;

class ProteinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $faker = Faker\Factory::create("pt_BR");

        for ($i=1; $i <= 100; $i++) {
            DB::table('protein')->insert([
                'descricao' => $faker->text(50), 
                'created_at' => now()               
            ]);
        }
    }
}
