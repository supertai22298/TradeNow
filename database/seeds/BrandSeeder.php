<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $brands = [
        ['name' => 'Không có', 'image' => '', 'thumbnail' => ''],
        ['name' => 'Sam Sung', 'image' => '', 'thumbnail' => ''],
        ['name' => 'Apple', 'image' => '', 'thumbnail' => ''],
        ['name' => 'Panasonic', 'image' => '', 'thumbnail' => ''],
        ['name' => 'LG', 'image' => '', 'thumbnail' => ''],
        ['name' => 'ALexa', 'image' => '', 'thumbnail' => ''],
        ['name' => 'Google', 'image' => '', 'thumbnail' => ''],
      ];

      foreach ($brands as $key => $brand) {
        DB::table('brands')->insert($brand);
      }
    }
}
