<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Não perecível';
        $category->description = 'Alimentos de consumo não perecíveis';
        $category->user_id = 1;
        $category->save();
    }
}
