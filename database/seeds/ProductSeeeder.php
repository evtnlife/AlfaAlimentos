<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = "Produto 1";
        $product->description = "Desc Produto 1";
        $product->price = 125.3;
        $product->cost = 111.3;
        $product->provider_id = 1;
        $product->category_id = 1;
        $product->quantity = 30;
        $product->user_id = 1;
        $product->branch_id = 1;
        $product->save();

        $product = new Product();
        $product->name = "Produto 2";
        $product->description = "Desc Produto 2";
        $product->price = 125.3;
        $product->cost = 111.3;
        $product->provider_id = 1;
        $product->category_id = 1;
        $product->quantity = 30;
        $product->user_id = 1;
        $product->branch_id = 2;
        $product->save();
    }
}
