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
                'date' => '2022-01-15',
                'time' => '22:15:03',
                'customer_name' => 'Giorgio Tognatti',
                'phone_number' => '3281234567',
                'email' => 'giorgio@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-01-16',
                'time' => '18:45:03',
                'customer_name' => 'Simona Flauto',
                'phone_number' => '3281234567',
                'email' => 'simona@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-01-19',
                'time' => '12:15:03',
                'customer_name' => 'Paolo Foggia',
                'phone_number' => '3281234567',
                'email' => 'paolo@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-02-15',
                'time' => '14:15:03',
                'customer_name' => 'Emanuela Candioli',
                'phone_number' => '3281234567',
                'email' => 'emanuela@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-02-16',
                'time' => '18:45:03',
                'customer_name' => 'Riccardo Serpenti',
                'phone_number' => '3281234567',
                'email' => 'serpenti@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-02-17',
                'time' => '10:15:03',
                'customer_name' => 'Fabio Renato',
                'phone_number' => '3281234567',
                'email' => 'fr@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-02-18',
                'time' => '08:15:03',
                'customer_name' => 'Carmine Pasqualicchio',
                'phone_number' => '3281234567',
                'email' => 'kionz@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-02-19',
                'time' => '18:15:03',
                'customer_name' => 'Elena Chiodi',
                'phone_number' => '3281234567',
                'email' => 'elena@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-03-15',
                'time' => '18:34:03',
                'customer_name' => 'Domenico Grago',
                'phone_number' => '3281234567',
                'email' => 'dodo@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-03-16',
                'time' => '21:15:03',
                'customer_name' => 'Pierpaolo Accattello',
                'phone_number' => '3281234567',
                'email' => 'pier@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-15',
                'time' => '18:15:03',
                'customer_name' => 'Clara Sella',
                'phone_number' => '3281234567',
                'email' => 'clara@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-16',
                'time' => '09:15:03',
                'customer_name' => 'Francesca Tinelli',
                'phone_number' => '3281234567',
                'email' => 'lafra@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-17',
                'time' => '18:15:03',
                'customer_name' => 'Gaia Macinato',
                'phone_number' => '3281234567',
                'email' => 'gaia@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-18',
                'time' => '11:15:03',
                'customer_name' => 'Fiona Serravalle',
                'phone_number' => '3281234567',
                'email' => 'fiona@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-19',
                'time' => '13:27:03',
                'customer_name' => 'Giangiacomo Como',
                'phone_number' => '3281234567',
                'email' => 'comocomo@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-20',
                'time' => '18:57:03',
                'customer_name' => 'Sergio Passato',
                'phone_number' => '3281234567',
                'email' => 'ser@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ],
            [
                'date' => '2022-04-21',
                'time' => '22:15:03',
                'customer_name' => 'Filippo Girondo',
                'phone_number' => '3281234567',
                'email' => 'filippo@gmail.it',
                'total' => 35.50,
                'address' => 'Via Pampluti, 3',
            ]
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
