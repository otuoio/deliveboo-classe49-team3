<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Luna Rossa',
                'email' => 'info@lunarossa.it',
                'password' => '12345678',
                'address' => 'Via Isonzo, 61',
                'p_iva' => '10214930967',
                'phone_number' => '0810031567',
                'shipment_price' => 2.50,
                'minimum_order' => 13.00,
                'image' => 'lunarossa.jpg',
                'show' => 1,
            ],
            [
                'name' => 'Perla Nera',
                'email' => 'info@perlanera.it',
                'password' => '12345678',
                'address' => 'Via Immobile, 10',
                'p_iva' => '10215430998',
                'phone_number' => '0810034567',
                'shipment_price' => 1.50,
                'minimum_order' => 7.00,
                'image' => 'perlanera.jpg',
                'show' => 1,
            ],
            [
                'name' => "O Cuopp' E Ciruzz",
                'email' => 'info@ocuoppeciruzz.it',
                'password' => '12345678',
                'address' => 'Corso Vittorio Emanuele II, 81',
                'p_iva' => '10215430555',
                'phone_number' => '0810013675',
                'shipment_price' => 0.50,
                'minimum_order' => 5.00,
                'image' => 'ocuoppeciruzz.jpg',
                'show' => 1,
            ],
        ];

        foreach ($users as $user){
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->password = Hash::make($user['password']);
            $newUser->slug = Str::slug($newUser->name, '-');
            $newUser->address = $user['address'];
            $newUser->p_iva = $user['p_iva'];
            $newUser->phone_number = $user['phone_number'];
            $newUser->shipment_price = $user['shipment_price'];
            $newUser->minimum_order = $user['minimum_order'];
            $newUser->image = 'uploads/' . $user['image'];
            $newUser->show = $user['show'];
            $newUser->save();
        }
    }
}
