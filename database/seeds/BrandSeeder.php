<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      $name = ['Sam Sung', 'Panasonic', 'Apple', 'Nokia'];
      while($i <= 4){
        DB::table('brands')->insert([
          'name' => $name[$i - 1],
          'image' => 'default_image.png',
          'thumbnail' => 'default_image.png',
          'description' => $name[$i - 1] . ' xin xin - from' . 'Trung Quốc',
          'created_at' => '2019/' . $i . '/11',
        ]);
        $i++;
      }
    }
}
