<?php

use Illuminate\Database\Seeder;
use App\Model\Order;
use App\Model\Dish;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders=Order::all();
        $dishes=Dish::all();
        foreach ($orders as $order) {
            $order->dishes()->attach($dishes[0],['qty'=>3]);
            $order->dishes()->attach($dishes[2],['qty'=>3]);
        }
    }
}
