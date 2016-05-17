<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //DB::table('users_type')->truncate();

      DB::table('users_type')->insert([
        'nom_user_type'  => 'Sistema',
        'activo'         => '1',
        'created_at'     => Carbon::now()
      ]);

      DB::table('users_type')->insert([
        'nom_user_type'  => 'Secretaria Académica',
        'activo'         => '1',
        'created_at'     => Carbon::now()
      ]);

      DB::table('users_type')->insert([
        'nom_user_type'  => 'Créditos y cobranzas',
        'activo'         => '1',
        'created_at'     => Carbon::now()
      ]);

      DB::table('users_type')->insert([
        'nom_user_type'  => 'Docente',
        'activo'         => '1',
        'created_at'     => Carbon::now()
      ]);

      DB::table('users_type')->insert([
        'nom_user_type'  => 'Alumno',
        'activo'         => '1',
        'created_at'     => Carbon::now()
      ]);

    }
}
