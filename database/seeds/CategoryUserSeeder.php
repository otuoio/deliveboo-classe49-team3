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
        $users[3]->categories()->attach($categories[0]);
        $users[3]->categories()->attach($categories[7]);
        $users[4]->categories()->attach($categories[1]);
        $users[5]->categories()->attach($categories[2]);
        $users[6]->categories()->attach($categories[3]);
        $users[7]->categories()->attach($categories[2]);
        $users[7]->categories()->attach($categories[4]);
        $users[8]->categories()->attach($categories[6]);
        $users[9]->categories()->attach($categories[8]);
        $users[10]->categories()->attach($categories[9]);
        $users[11]->categories()->attach($categories[10]);
        $users[12]->categories()->attach($categories[11]);
        $users[13]->categories()->attach($categories[12]);
        $users[14]->categories()->attach($categories[9]);
        $users[15]->categories()->attach($categories[10]);
    }
}
