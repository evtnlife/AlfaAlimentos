<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provider = new Provider();
        $provider->name = 'Everton';
        $provider->description = 'Teste de conteúdo';
        $provider->document = '21.490.536/0001-02';
        $provider->document_type = 'CNPJ';
        $provider->phone = '(31)98752-5943';
        $provider->email = 'algumacoisa@eba.com';
        $provider->responsible = 'não sei';
        $provider->user_id = 1;
        $provider->save();
    }
}
