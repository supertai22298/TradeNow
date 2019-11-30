<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      $name = ['Điện thoại', 'Máy tính', 'Gia dụng', 'Điện lạnh'];
      while($i <= 4){
        DB::table('categories')->insert([
          'name' => $name[$i - 1],
          'image' => 'default_image.png',
          'thumbnail' => 'default_image.png',
          'description' => $name[$i - 1] . 'xin xin',
          'parent_id' => 0,
          'created_at' => '2019/' . $i . '/11',
        ]);
        $i++;
      }
    }
}
