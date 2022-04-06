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
            ],
            [
                'name' => "I Tre Scugnizzi",
                'email' => 'info@itrescugnizzi.it',
                'password' => '12345678',
                'address' => 'Corso Roma, 2',
                'p_iva' => '10215433655',
                'phone_number' => '0810435675',
                'shipment_price' => 1.50,
                'minimum_order' => 5.00,
                'image' => 'itrescugnizzi.jpg',
            ],
            [
                'name' => "Sao Sushi",
                'email' => 'info@saosushi.it',
                'password' => '12345678',
                'address' => 'Via della Buca, 2',
                'p_iva' => '10222433655',
                'phone_number' => '0818165675',
                'shipment_price' => 2.50,
                'minimum_order' => 15.00,
                'image' => 'saosushi.jpg',
            ],
            [
                'name' => "Toy Mochi",
                'email' => 'info@toymochi.it',
                'password' => '12345678',
                'address' => 'Via Vespucci, 7',
                'p_iva' => '10222111655',
                'phone_number' => '0818161175',
                'shipment_price' => 1.50,
                'minimum_order' => 3.00,
                'image' => 'toymochi.jpg',
            ],
            [
                'name' => "Umbria Poke",
                'email' => 'info@umbriapoke.it',
                'password' => '12345678',
                'address' => 'Viale dei Telegrafi, 78',
                'p_iva' => '10222112345',
                'phone_number' => '0818123475',
                'shipment_price' => 2.50,
                'minimum_order' => 10.00,
                'image' => 'umbriapoke.jpg',
            ],
            [
                'name' => "Settimo Gelo",
                'email' => 'info@settimogelo.it',
                'password' => '12345678',
                'address' => 'Via Fredda, 1',
                'p_iva' => '10222666776',
                'phone_number' => '0818121234',
                'shipment_price' => 2.50,
                'minimum_order' => 10.00,
                'image' => 'settimogelo.jpg',
            ],
            [
                'name' => "Il Fiore Di Loto",
                'email' => 'info@ilfiorediloto.it',
                'password' => '12345678',
                'address' => 'Via della Ghisiliera, 13',
                'p_iva' => '10222367776',
                'phone_number' => '0818333234',
                'shipment_price' => 2.50,
                'minimum_order' => 5.00,
                'image' => 'ilfiorediloto.jpg',
            ],
            [
                'name' => "El Hombre De La Torre",
                'email' => 'info@elhombredelatorre.it',
                'password' => '12345678',
                'address' => 'Via Tomo, 123',
                'p_iva' => '10222435676',
                'phone_number' => '0818339934',
                'shipment_price' => 3.50,
                'minimum_order' => 8.00,
                'image' => 'elhombredelatorre.jpeg',
            ],
            [
                'name' => "Elk Bakery",
                'email' => 'info@elkbakery.it',
                'password' => '12345678',
                'address' => 'Via Tal dei Tali',
                'p_iva' => '14284292409',
                'phone_number' => '3315762346',
                'shipment_price' => 1.50,
                'minimum_order' => 5.00,
                'image' => 'elkbakery.jpg',
            ],
            [
                'name' => "Aniello's street food",
                'email' => 'info@aniellos.it',
                'password' => '12345678',
                'address' => 'Corso del Popolo, 1',
                'p_iva' => '15825820242',
                'phone_number' => '3356678981',
                'shipment_price' => 2.50,
                'minimum_order' => 10.00,
                'image' => 'aniellos.jpg',
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
            $newUser->save();
        }
    }
}
