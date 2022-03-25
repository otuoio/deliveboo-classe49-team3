<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Model\Category;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $categories = Category::all();

        $users[0]->categories()->attach($categories[0]);
        $users[1]->categories()->attach($categories[5]);
        $users[2]->categories()->attach($categories[7]);

    }
}
