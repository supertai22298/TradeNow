<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
        ['name' => 'Thời trang', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
        ['name' => 'Điện lạnh', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
        ['name' => 'Điện thoại', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
        ['name' => 'Thể thao', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
        ['name' => 'Phụ kiện điện tử', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
        ['name' => 'Phụ kiện thời trang', 'image' => '', 'thumbnail' => '', 'parent_id' => 0],
      
      ];

      foreach ($categories as $key => $cate) {
        DB::table('categories')->insert($cate);
      }
    }
}
