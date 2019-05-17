<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // cria um usuário administrador
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'level' => 'Administrador',
            'remember_token' => str_random(10),
            'created_at' => now()
        ]);

        // cria outros 5 usuários fakers
        $faker = Faker\Factory::create('pt_BR');
        $levels = [ 'Administrador', 'Usuário' ];
        $genders = [ 'M', 'F', 'N'];

        for ($i=1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'gender' =>$faker->randomElement($genders),
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('secret'),
                'level' => $faker->randomElement($levels),
                'remember_token' => str_random(10),
                'created_at' => now()
            ]);
        }
    }
}
