<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //DB::table('users')->truncate();

      $faker = Faker::create();

      foreach (range(1,5) as $key => $value) {
        DB::table('users')->insert([
          'username'      => $faker->name,
          'email'         => $faker->email,
          'password'      => bcrypt('secret'),
          'id_user_type'  => rand(1,5),
          'activo'        => 1
        ]);

      }
    }
}
