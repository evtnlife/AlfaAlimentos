<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = new Branch();
        $branch->name = "CL - Alfa Alimentos";
        $branch->address_id = 1;
        $branch->save();
        $branch = new Branch();
        $branch->name = "POA - Alfa Alimentos";
        $branch->address_id = 1;
        $branch->save();
    }
}
