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
                'name' => 'Margherita',
                'image' => 'margherita.jpg',
                'description' => 'Pomodoro, fior di latte e basilico',
                'price' => 4.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Marinara',
                'image' => 'marinara.jpg',
                'description' => 'Pomodoro, aglio, origano',
                'price' => 4.00,
                'visible' => 1,
                'vegan' => 1,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => '4 Stagioni',
                'image' => '4stagioni.jpg',
                'description' => 'Pomodoro, fior di latte, salame, zucchine, funghi, prosciutto cotto, basilico',
                'price' => 6.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Ortolana',
                'image' => 'ortolana.jpg',
                'description' => 'Pomodoro, fior di latte, melanzane fritte, zucchine e funghi freschi',
                'price' => 6.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Doc',
                'image' => 'doc.jpg',
                'description' => 'Pomodorini datterini, mozzarella di bufala, basilico',
                'price' => 6.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Calabrese',
                'image' => 'calabrese.jpg',
                'description' => 'Pomodoro, fior di latte, salame, cipolla, peperoncino, basilico',
                'price' => 5.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'Ischitana',
                'image' => 'ischitana.jpg',
                'description' => 'Pomodorini datterini, mozzarella di bufala, prosciutto crudo, rucola, scaglie di parmigiano',
                'price' => 8.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
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
                'name' => 'Siciliana',
                'image' => 'siciliana.jpg',
                'description' => 'Pomodoro, acciughe, origano, olive nere, capperi, basilico',
                'price' => 6.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Romana',
                'image' => 'romana.jpg',
                'description' => 'Pomodoro, fior di latte, acciughe, origano, basilico',
                'price' => 6.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Mondial',
                'image' => 'mondial.jpg',
                'description' => 'Fior di latte, pomodorini datterini, capperi, olive nere, origano, basilico',
                'price' => 6.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Lasagna',
                'image' => 'lasagna.jpg',
                'description' => 'Pomodoro, fior di latte, prosciutto cotto, ricotta, basilico',
                'price' => 6.50,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Cicolone',
                'image' => 'cicolone.jpg',
                'description' => 'Ombra di pomodoro, provola, ricotta, cicoli, pepe, basilico',
                'price' => 7.00,
                'visible' => 1,
                'vegan' => 0,
                'spicy' => 0,
                'user_id' => 1,
            ],
            [
                'name' => 'Positano',
                'image' => 'positano.jpg',
                'description' => 'Fior di latte, gorgonzola, salame, cipolla, basilico',
                'price' => 7.50,
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
