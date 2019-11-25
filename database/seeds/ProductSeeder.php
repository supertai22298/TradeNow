<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      $name = ['Sam Sung', 'Iphone', 'Xiaomi Mi', 'Nokia', 'Panasonic', 'S', 'K20'];
      while($i <= 10){
        DB::table('products')->insert([
          'name' => $name[rand(0,6)] . rand(1,100),
          'category_id' => rand(1,4),
          'brand_id' => rand(1,4),
          'user_id' => rand(1,10),
          'product_status_id' => 1,
          'description' => 'Màn Hình Cực Lớn 6.5" - Chiến Game Mạnh Mẽ Với Snapdragon 655 - Đa Nhiệm Mạnh Mẽ 8GB RAM. 04 Camera Trải Nghiệm Đẳng Cấp Nhiếp Ảnh - Camera Selfie 16MP, Hỗ Trợ Làm Đẹp Bằng A.I. Giải Trí Chuyên Nghiệp. Trải Nghiệm Tối Đa. Hiệu Năng Bứt Phá.',
          'price' => rand(1,20) ."000000",
          'amount' => rand(5,9),
          'title_seo' => $name[rand(0,6)] . rand(1,100),
          'description_seo' => $name[rand(0,6)] . rand(1,100),
          'created_at' => '2019/' . $i . '/11',
          'is_checked' => rand(0,2),
        ]);
        $i++;
      }
    }
}
