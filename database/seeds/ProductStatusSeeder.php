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
        'name' => 'Hàng từ nhà cung cấp',
        'description' => 'Nhập khẩu từ ' . 'Trung Quốc',
      ]);
    }
}
