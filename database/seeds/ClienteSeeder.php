<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $client->name = "Cliente Sede 1 ";
        $client->email = "cliente@cliente.com";
        $client->phone = "333333333";
        $client->document = "394.444.444-44";
        $client->document_type = 'CPF';
        $client->status='BOM';
        $client->branch_id = 1;
        $client->address_id = 1;
        $client->observation="Excelente cliente!!";
        $client->save();

        $client = new Client();
        $client->name = "Cliente Sede 2 ";
        $client->email = "cliente@cliente.com";
        $client->phone = "333333333";
        $client->document = "394.444.444-54";
        $client->document_type = 'CPF';
        $client->status='REGULAR';
        $client->branch_id = 2;
        $client->address_id = 1;
        $client->observation="Paga atrasado";
        $client->save();

        $client = new Client();
        $client->name = "Cliente Sede 2.0DASDS ";
        $client->email = "cliente@cliente.com";
        $client->phone = "333333333";
        $client->document = "394.444.444-54";
        $client->document_type = 'CPF';
        $client->status='RUIM';
        $client->branch_id = 2;
        $client->address_id = 1;
        $client->observation="Nunca paga";
        $client->save();
    }
}
