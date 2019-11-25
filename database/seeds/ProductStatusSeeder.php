<?php

use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('product_statuses')->insert([
        'name' => 'Hàng brand new',
        'description' => 'Nhập khẩu từ ' . 'Trung Quốc',
        'created_at' => '2019/01/11',
      ]);
    }
}
