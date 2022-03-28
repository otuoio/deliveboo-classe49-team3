<?php

use Illuminate\Database\Seeder;
use App\Model\Order;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                'date' => '2022-03-15',
                'time' => '18:15:03',
                'customer_name' => 'Paolo Foggia',
                'phone_number' => '3281234567',
                'email' => 'paolo@foggia.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
        ];

        foreach ($orders as $order){
            $newOrder = new Order();
            $newOrder->date = $order['date'];
            $newOrder->time = $order['time'];
            $newOrder->customer_name = $order['customer_name'];
            $newOrder->phone_number = $order['phone_number'];
            $newOrder->email = $order['email'];
            $newOrder->total = $order['total'];
            $newOrder->address = $order['address'];
            $newOrder->save();
        }
    }
}
