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
          'email' => 'tigernguyen110'.$i.'@gmail.com',
          'email_verified_at' => now(),
          'date_of_birth' => '1998/' . $i . '/11',
          'address' => $i.'/Thang binh',
          'city' => 'Đà Nẵng',
          'phone_number' => 0365225603,
          'gender' => rand(0,1),
          'description' => "Mô tả" . $i . ' - ' . rand(1,10000),
          'password' => bcrypt('admin'),
          'created_at' => '2019/' . $i . '/11',
          'is_admin' => rand(0,1),
          'active' => rand(0,1),
        ]);
        $i++;
      }
    }
}
