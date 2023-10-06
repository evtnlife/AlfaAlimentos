<?php

namespace App\Http\Controllers;

use App\Address;
use App\City;
use App\Client;
use App\Product;
use Carbon\Carbon;
use DateTime;
use App\Sale;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class ReportController extends Controller
{
    public function financial()
    {
        $sales = Sale::all();
        $client = Client::has('Sales')->orderBy('name', 'asc')->get();
        return view('report.financial')->with([
            'sales' => $sales,
            'client' => $client
        ]);
    }

    public function clientCollection()
    {
        return view('report.clientsCollection');
    }

    public function getListClientByDate($InicialDate, $EndDate)
    {
        $IniDate = new DateTime($InicialDate);
        $EDate = new DateTime($EndDate);
        $clientsAux = DB::select(DB::raw(
            "SELECT distinct
                    s.id,
                    s.total,
                    s.created_at,
                    s.payment_type,
                    s.qtd_parcels,
                    s.client_id,
                    s.payment_day,
                    s.branch_id,
                    s.inicial_date,
		            (case when (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) is null then   0
		                ELSE
			        (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id)
		            END) as totalPaid
                    FROM sales s
                    LEFT OUTER JOIN sale_payments sp
                    ON s.id = sp.sale_id
                    WHERE (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) < s.total
                    OR (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) IS null
                    AND s.branch_id = :branch_id"), array('branch_id' => Cookie::get('branch_id')));
        $arrayClients = [];
        $clientIndex = 0;
        foreach ($clientsAux as $item) {
            $count = 0;
            for ($i = 0; $i < $item->qtd_parcels; $i++) {
                $client = Client::find($item->client_id);
                $address = Address::find($client->address_id);
                $city = City::find($address->cities_id);
                $state = State::find($city->state_id);
                $endereco = $address->street . ", <br/>Nº: " . $address->number . " <br/> Bairro: " . $address->district . " <br/> " . $city->name . " - " . $state->name . "<br/> Referência:" . $address->reference;
                $data = Carbon::createFromTimestamp(strtotime(('+' . $count . ' month'), strtotime($item->inicial_date)));
                if ($IniDate <= $data && $EDate >= $data && $item->payment_day > 0) {
                    $valorParcelaAux = $item->total / $item->qtd_parcels;
                    $valorParcela = number_format($valorParcelaAux, 2, ",", ",");
                    $total = number_format($item->total, 2, ",", ",");
                    $arrayClients[$clientIndex] = [
                        "id" => $item->id,
                        "nome" => $client->name,
                        "telefone" => $client->phone,
                        "email" => $client->email,
                        "endereco" => $endereco,
                        "total" => $total,
                        "valorParcela" => $valorParcela,
                        "parcela" => $i + 1,
                        "data" => $data
                    ];
                    $clientIndex++;
                }
                $count++;
            }
        }

        return response()->json(
            [
                'clients' => $arrayClients
            ],
            200
        );
    }

    public function getSalesByFilters(Request $request)
    {
        $request = $request->all();
        $str = "SELECT DISTINCT
              s.id,
              cl.name,
              s.total,
              s.cost,
              s.discount,
                (case
                when (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) is null then
                    0
                ELSE
                    (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id)
                END) as totalPaid,
              (CASE WHEN (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) < s.total THEN 'PENDENTE'
                    WHEN (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) IS NULL THEN 'PENDENTE'
                      ELSE 'PAGO'
                END) StatusPagamento,
              s.created_at
          FROM sales s
          LEFT OUTER JOIN sale_payments sp
          ON s.id = sp.sale_id
          LEFT OUTER JOIN clients cl
          ON s.client_id = cl.id
          WHERE s.branch_id = ". Cookie::get('branch_id') . " ";
        if ($request['dth_ini'] != null) {
            $str .= " AND ";
            $str .= "DATE(s.created_at) >= '". $request['dth_ini']."'";
        }
        if ($request['dth_fim'] != null) {
            $str .= " AND ";
            $str .= "DATE(s.created_at) <= '". $request['dth_fim']."'";
        }
        if ($request['status'] != null && $request['status'] != -1) {
            $str .= " AND ";
            $str .= "(CASE WHEN (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) < s.total THEN 'PENDENTE'
                        WHEN (SELECT SUM(total) FROM sale_payments WHERE sale_id = s.id) IS NULL THEN 'PENDENTE'
                        ELSE 'PAGO'
                        END) = '".$request['status']."'";
        }
        if ($request['client'] != null && $request['client'] != -1) {
            $str .= " AND ";
            $str .= "s.client_id = ".$request['client'];
        }

        $sales = DB::select(DB::raw($str));

        return response()->json(['sales' => $sales], 200);
    }
}
