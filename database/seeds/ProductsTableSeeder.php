<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classificationsIDs = DB::table('classifications')->select('id')->get();
        $providersIDs = DB::table('providers')->select('id')->get();

        $faker = Faker\Factory::create("pt_BR");

        for ($i=1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'descricao' => $faker->text(50),
                'qtd' => $faker->randomNumber(4),
                'estoque_minimo' => $faker->randomNumber(4),
                'prc_venda' => $faker->randomFloat(2, 10, 9999),
                'prc_compra' => $faker->randomFloat(2, 10, 9999),
                'classification_id' => $faker->randomElement($classificationsIDs)->id,
                'provider_id' => $faker->randomElement($providersIDs)->id,
                'created_at' => now()
            ]); 
        }
    }
}
