<?php

use Illuminate\Database\Seeder;
use App\Kit;
use App\KitProduct;

class KitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kit = new Kit();
        $kit->name = 'kit test 1';
        $kit->description = 'Teste';
        $kit->price = 10;
        $kit->cost = 10;
        $kit->user_id = 1;
        $kit->branch_id = 1;
        $kit->save();

        $kitProduct = new kitProduct();
        $kitProduct->kit_id = $kit->id;
        $kitProduct->product_id = '1';
        $kitProduct->user_id = '1';
        $kitProduct->save();
    }
}
