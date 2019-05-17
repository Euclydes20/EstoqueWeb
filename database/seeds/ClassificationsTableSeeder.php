<?php

use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create("pt_BR");

        for ($i=1; $i <= 35; $i++) {
            DB::table('classifications')->insert([
                'descricao' => $faker->text(30),
                'created_at' => Carbon\Carbon::now()
            ]);
        }
    }
}
