<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      while($i <=10){
        DB::table('users')->insert([
          'name' => 'Nguyễn Chiếm Hảo' . rand(1,1000),
          'email' => 'tigernguyen220'.$i.'@gmail.com',
          'password' => bcrypt('admin'),
          'is_admin' => rand(0,1),
          'active' => rand(0,1),
        ]);
        $i++;
      }
    }
}
