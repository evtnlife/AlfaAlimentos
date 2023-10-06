<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EnderecoSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ProductSeeeder::class);
        $this->call(KitSeeder::class);
    }
}
