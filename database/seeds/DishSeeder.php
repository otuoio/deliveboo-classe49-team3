<?php

use Illuminate\Database\Seeder;
use App\Model\Dish;
use Illuminate\Support\Str;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = [
            [
                'name' => 'Salsiccia e friarielli',
                'image' => 'salsiccia_friarielli.jpg',
                'description' => 'Mozzarella, salsiccia a punta di coltello, friarielli',
                'price' => 6.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Marinara',
                'image' => 'marinara.jpg',
                'description' => 'Pomodoro, aglio, origano',
                'price' => 4.50,
                'visible' => 1,
                'vegan' => 1,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Mascarella',
                'image' => 'mascarella.jpg',
                'description' => 'Birra session IPA 10% da 40cl',
                'price' => 4.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Big Joe',
                'image' => 'big_joe.jpg',
                'description' => "200 grammi di scottona, cheddar, bacon, pomodoro confit, salsa Jack Daniel's",
                'price' => 10.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 2,
            ],
            [
                'name' => 'Kraken',
                'image' => 'kraken.jpg',
                'description' => "pan brioche artigianale, 5 hamburger (750gr in totale) di scottona grass feed allevata esclusivamente a erba, 10 fette di bacon affumicato, 5 fette di cheddar inglese e maionese al bacon fatta in casa",
                'price' => 27.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 2,
            ],
            [
                'name' => 'Veggie burger',
                'image' => 'veggie_burger.jpg',
                'description' => "Hamburger di soia, pomodoro, lattuga, fungo fritto, maionese vegana",
                'price' => 13.00,
                'visible' => 1,
                'vegan' => 1,
                'spicy' => 0,
                'user_id' => 2,
            ],
            [
                'name' => 'Le alici di Annunziata',
                'image' => 'alici_annunziata.jpg',
                'description' => 'Puntarelle e colatura di alici',
                'price' => 8.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 3,
            ],
            [
                'name' => 'Spaghetti allo scoglio',
                'image' => 'spaghetti_scoglio.jpg',
                'description' => 'Spaghetti con misto pesce e crostacei',
                'price' => 13.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 3,
            ],
            [
                'name' => 'Martinelli di lago',
                'image' => 'martinelli_lago.jpg',
                'description' => 'Martinelli con carciofi e menta',
                'price' => 14.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 1,
                'user_id' => 3,
            ],
        ];

        foreach ($dishes as $dish){
            $newDish = new Dish();
            $newDish->name = $dish['name'];
            $newDish->slug = Str::slug($newDish->name, '-');
            $newDish->description = $dish['description'];
            $newDish->price = $dish['price'];
            $newDish->visible = $dish['visible'];
            $newDish->vegan = $dish['vegan'];
            $newDish->spicy = $dish['spicy'];
            $newDish->user_id = $dish['user_id'];
            $newDish->image = 'uploads/'. $dish['image'];
            $newDish->save();
        }
    }
}
