<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'pizza',
            'sushi',
            'dessert',
            'poke',
            'gelato',
            'hamburger',
            'cinese',
            'mediterranea',
            'messicana',
            'colazione',
            'fast food',
            'indiana',
            'carne',
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->save();
        }
    }
}
