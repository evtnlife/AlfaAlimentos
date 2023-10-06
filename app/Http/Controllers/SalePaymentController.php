<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Client;
use App\SalePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SalePaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('schedule.index');
    }

    /**
     * Obtem o calendario da branch atual
     */
    public function getCalendar()
    {
        $sales = Sale::with('SalePayments')
            ->with('Client')
            ->where('branch_id', Cookie::get('branch_id'))
            ->where('payment_type', 'PA')
            ->orWhere('payment_type', 'EP')
            ->get();

        $calendar = [];
        $calendarCount = 0;
        $dthAtual = Carbon::now();
        $dthMin = $sales->min(function ($item) {
            return $item->created_at;
        });
        $dthMax = $sales->max(function ($item) {
            return $item->created_at;
        });
        foreach ($sales as $sale) {
            $totalPago = $sale->SalePayments->sum(function ($item) {
                return $item->total;
            });
            $dthUltPag = $sale->SalePayments->max(function ($item) {
                return $item->created_at;
            });
            $qtdPagamentos = $sale->SalePayments->count();
            $restantePagar = $sale->total - $totalPago;
            if ($restantePagar > 0) {
                $totalParcel = $sale->qtd_parcels;
                $parcelCount = 1;
                while ($parcelCount < $totalParcel + 1) {
                    $dthReg = Carbon::createFromTimestamp(strtotime(('+' . $parcelCount . ' month'), strtotime($sale->created_at)));
                    $dthReg->day = $sale->payment_day;
                    $dthReg->day = $sale->payment_day;
                    $color = "";
                    if ($dthReg < $dthAtual)
                        $color = '#808080';
                    else if ($dthReg == $dthAtual)
                        $color = '#f56954';
                    else if (($dthReg->day - 5) <= $dthAtual->day && $dthReg->month == $dthAtual->month)
                        $color = '#f39c12';
                    else
                        $color = '#00a65a';
                    $calendar[$calendarCount++] = [
                        'title' => $sale->Client->name,
                        'start' => $dthReg,
                        'allDay' => true,
                        'backgroundColor' => $color,
                        'borderColor' => $color
                    ];
                    $parcelCount++;
                }
            }
        }
        return response()->json([
            'calendar' => $calendar,
            'dthMin' => $dthMin,
            'dthMax' => $dthMax
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Http\Response
     */
    public function show(SalePayment $salePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SalePayment $salePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalePayment $salePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalePayment $salePayment)
    {
        //
    }
    /**
     * Adiciona um pagamento
     *
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPayment(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'sale_id' => 'required|numeric',
            'total' => 'required|numeric',
            'dth_payment' => '',
            'payment_type' => ''
        ]);
        if($request['total']>$request['rest']){
            return redirect()->back()->with([
                'status' => "Não é possível inserir um pagamento que excede o restante devido!"
            ]);
        }else{
            $salePayment = new SalePayment();
            $salePayment->total = $validatedData['total'];
            $salePayment->sale_id = $validatedData['sale_id'];
            $salePayment->user_id = $validatedData['user_id'];
            $salePayment->payment_type = $validatedData['payment_type'];
            $salePayment->dth_payment = $validatedData['dth_payment'] == null ? Carbon::now() : $validatedData['dth_payment'];
            $salePayment->save();
            return redirect()->back()->with([
                'status' => "Pagamento inserido com sucesso!"
            ]);
        }
    }
    /**
     * Exibe formulário de creditar valor em divida ativa de cliente
     *
     * @param \App\SalePayment $salePayment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payment()
    {
        $clients = Client::has('Sales')->with('Sales')->where('branch_id', Cookie::get('branch_id'))->get();
        return view('sale.salePayment')->with(['clients' => $clients]);
    }

    public function getSalesInformations($sale)
    {
        $informationsPayment = [];
        $informations = [];
        $informationSale = Sale::find($sale);
        $payed = 0;
        $informationSalePayment = SalePayment::where('sale_id',$informationSale->id)->get();
            foreach ($informationSalePayment as $item){
                $payed = $payed + $item->total;
                array_push($informationsPayment,[
                    "total" => number_format($item->total,2,",",","),
                    "data" => $item->dth_payment,
                ]);
            }
            $rest = $informationSale->total-$payed;
            $informations[0] = [
                "id" => $informationSale->id,
                "total" => number_format($informationSale->total,2,",",","),
                "cost" => number_format($informationSale->cost,2,",",","),
                "rest" => number_format($rest,2,",",","),
                "restUnformated" => $rest,
                "totalPayed" => number_format($payed,2,",",","),
                "discount" => number_format($informationSale->discount,2,",",","),
                "payment_type" => $informationSale->payment_type,
                "qtd_parcels" => $informationSale->qtd_parcels,
                "payment_day" => $informationSale->payment_day,
                "informationsPayment" => $informationsPayment
            ];
        return response()->json([
            'information'=>$informations
            ], 200
        );
    }
    public function getSales($client)
    {
        $sales = DB::select(DB::raw(
            "SELECT distinct
                        s.id,
                        s.total,
                        s.created_at,
                        s.payment_type,
                        (SELECT SUM(total) FROM Sale_PAYMENTS WHERE sale_id = s.id) as totalPaid,
                        (CASE WHEN (SELECT SUM(total) FROM Sale_PAYMENTS WHERE sale_id = s.id) < s.total THEN 'PENDENTE'
                            WHEN (SELECT SUM(total) FROM Sale_PAYMENTS WHERE sale_id = s.id) IS NULL THEN 'PENDENTE'
                        ELSE	'PAGO' END) StatusPagamento
                    FROM sales s
                    LEFT OUTER JOIN sale_payments sp
                    ON s.id = sp.sale_id
                    WHERE s.client_id = :client_id"), array('client_id' => $client,));
        return response()->json([
                'sales' => $sales
            ], 200
        );
    }
}
