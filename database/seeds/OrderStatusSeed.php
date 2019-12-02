<?php

use Illuminate\Database\Seeder;

class OrderStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $orderStatused = [
            ['name' => 'Đặt hàng thành công', 'priority' => 15],
            ['name' => 'Đã tiếp nhận đơn hàng', 'priority' => 25],
            ['name' => 'Đang đóng gói - Sẵn sàng giao hàng', 'priority' => 35],
            ['name' => 'Đã giao cho bộ phận vận chuyển', 'priority' => 45],
            ['name' => 'Đang vận chuyển', 'priority' => 50],
            ['name' => 'Giao hàng thành công', 'priority' => 100],
            ['name' => 'Hàng bị trả về', 'priority' => 111],
            ['name' => 'Đơn hàng đã huỷ', 'priority' => 124],
        ];
        foreach($orderStatused as $item) {
            DB::table('order_statuses')->insert($item);
        }
    }
}
