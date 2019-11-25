<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      $subject = ['Hello world', 'Hello Bro', 'Báo lỗi', 'Thông báo', 'Góp ý kiến', 'Đăng ký nhận thông tin'];
      $name = ['Vượng', 'Hảo', 'Tài', 'Thuận'];
      $email = ['tigersama2205@gmail.com', 'supertai22298@gmail.com'];
      while($i <= 10){
        DB::table('contacts')->insert([
          'name' => $name[rand(0,3)] . rand(1,100),
          'subject' => $subject[rand(0,5)],
          'email' => $email[rand(0,1)],
          'phone_number' => '036522560' . $i,
          'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. In optio, adipisci, dolore suscipit vitae sit excepturi odio cupiditate veritatis asperiores rem dolores labore consectetur dolor reprehenderit nostrum voluptatum doloribus nemo?',
          'read_at' => null,
          'is_star' => rand(0,1),
          'created_at' => '2019/' . $i . '/11',
        ]);
        $i++;
      }
    }
}