<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Nguyễn Chiếm Hảo',
        'email' => 'tigernguyen2205@gmail.com',
        'password' => bcrypt('admin'),
        'is_admin' => true,
        'active' => true,
      ]);
      DB::table('categories')->insert([
        'name' => 'Điện thoại',
        'image' => 'default_image.png',
        'thumbnail' => 'default_image.png',
        'description' => 'Điện thoại xin xin',
        'parent_id' => 0,
      ]);
      DB::table('categories')->insert([
        'name' => 'Máy tính',
        'image' => 'default_image.png',
        'thumbnail' => 'default_image.png',
        'description' => 'Máy tính bự bự',
        'parent_id' => 0,
      ]);
      DB::table('categories')->insert([
        'name' => 'Điện lạnh',
        'image' => 'default_image.png',
        'thumbnail' => 'default_image.png',
        'description' => 'Điện máy xanh',
        'parent_id' => 0,
      ]);
      DB::table('brands')->insert([
        'name' => 'Hàn Quốc',
        'image' => 'default_image.png',
        'thumbnail' => 'default_image.png',
        'description' => 'Hàn xẻng',
      ]);
      DB::table('brands')->insert([
        'name' => 'Mỹ',
        'image' => 'default_image.png',
        'thumbnail' => 'default_image.png',
        'description' => 'Mỹ tho',
      ]);
      DB::table('product_statuses')->insert([
        'name' => 'Còn hàng',
        'description' => 'dỏm',
      ]);
      DB::table('product_statuses')->insert([
        'name' => 'Hết hàng',
        'description' => 'xịn',
      ]);
      DB::table('products')->insert([
        'name' => 'Iphone 11',
        'category_id' => 1,
        'brand_id' => 1,
        'user_id' => 1,
        'product_status_id' => 1,
        'description' => "mắc vl",
        'price' => "10000000000",
        'amount' => 5,
        'is_checked' => 0,
      ]);
      DB::table('products')->insert([
        'name' => 'Iphone 11 pro',
        'category_id' => 1,
        'brand_id' => 2,
        'user_id' => 1,
        'product_status_id' => 1,
        'description' => "mắc vl",
        'price' => "10000000000",
        'amount' => 5,
        'is_checked' => 1,
        'violation' => "mắc vl",
      ]);
      DB::table('products')->insert([
        'name' => 'Iphone 11 pro max',
        'category_id' => 1,
        'brand_id' => 2,
        'user_id' => 1,
        'product_status_id' => 2,
        'description' => "mắc vl",
        'price' => "10000000000",
        'amount' => 5,
        'is_checked' => 1,
        'violation' => "bán thận",
      ]);
      DB::table('products')->insert([
        'name' => 'Iphone 11',
        'category_id' => 2,
        'brand_id' => 1,
        'user_id' => 2,
        'product_status_id' => 1,
        'description' => "mắc vl",
        'price' => "10000000000",
        'amount' => 5,
        'is_checked' => 1,
      ]);
      DB::table('products')->insert([
        'name' => 'Iphone 11',
        'category_id' => 2,
        'brand_id' => 2,
        'user_id' => 2,
        'product_status_id' => 2,
        'description' => "mắc vl",
        'price' => "10000000000",
        'amount' => 5,
        'is_checked' => 1,
      ]);
      // $this->call(UsersTableSeeder::class);
    }
  }
