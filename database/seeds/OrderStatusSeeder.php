<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $i = 1;
      $name = ['Đang giao', 'Đã giao', 'Đã hủy'];
      while($i <= 3){
        DB::table('order_statuses')->insert([
          'name' => $name[$i-1],
          'description' => $name[$i-1],
          'created_at' => '2019/01/11',
        ]);
        $i++;
      }
    }
}
