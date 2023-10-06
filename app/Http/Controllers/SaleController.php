<?php

namespace App\Http\Controllers;

use App\Category;
use App\Client;
use App\Kit;
use App\Product;
use App\Sale;
use App\SaleItem;
use App\SalePayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clients = Client::has('Sales')->get();
        return view('sale.index')->with(['clients' => $clients]);
    }

    public function getSalesByClient($id)
    {
        $sales = DB::select(DB::raw(
            "SELECT distinct
                    s.id,
                    s.total,
                    s.payment_type,
                    s.payment_day,
                    s.qtd_parcels,
                    s.created_at,
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
                    AND s.branch_id = :branch_id and s.client_id = :client_id"),
            array(
                'branch_id' => Cookie::get('branch_id'),
                'client_id' => $id
                ));
        return response()->json(['sales' => $sales], 200);
    }

    public function EditPaymmentDay(Request $request){
        $request = $request->all();
        $sale = Sale::find($request['id']);
        if($sale != null){
            $sale->payment_day = $request['dth_payment'];

            if($request['data_cobranca']!= null){
                $sale->inicial_date = $request['data_cobranca'];
            }

            $sale->save();
        }
        return redirect()->back()->with(['status' => 'Data de cobrança alterada com sucesso!']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $clients = Client::where('branch_id', Cookie::get('branch_id'))->get();
        return view('sale.create')->with(['categories' => $categories, 'clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $request = $request->all();
        $products = $request['product_list'];

        Log::channel('payment_log')->info('Sale Received: ' . json_encode($request) . ']');

        // Inserir venda na tabela de vendas
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['qtd'];
        }, $products));
        $cost = array_sum(array_map(function ($item) {
            $object = null;
            if ($item['isKit'] == "Sim")
                $object = Kit::find($item['id']);
            else
                $object = Product::find($item['id']);
            return $object->cost * $item['qtd'];
        }, $products));
        $inidate = Date($request['inicial_date']);
        $discountCalculated = $request['discount_type'] == "$" ? $request['discount'] : ($total * $request['discount']) / 100;
        $sale = new Sale();
        $sale->total = $total - $discountCalculated;
        $sale->cost = $cost;
        $sale->discount = $discountCalculated;
        $sale->payment_type = $request['payment_type'];
        $sale->user_id = Auth::user()->id;
        $sale->client_id = $request['client_id'];
        $sale->branch_id = Cookie::get('branch_id');

        $sale->inicial_date = $request['inicial_date'];
        $sale->payment_day = ($request['payment_type'] == "AV" || $request['payment_type'] == "CC") ? 0 : $request['dth_cobranca'];
        $sale->qtd_parcels = ($request['payment_type'] == "AV" || $request['payment_type'] == "CC") ? 0 : $request['qtd_parcelas'];;
        if ($sale->save()) {
            //Inserir produtos na  tabela de vendas
            foreach ($products as $item) {
                $saleItem = new SaleItem();
                $saleItem->sale_id = $sale->id;
                if ($item['isKit'] == "Sim") {
                    $saleItem->kit_id = $item['id'];
                    $kit = Kit::with('Products')->find($item['id']);
                    $kitCost = 0;
                    foreach ($kit->Products as $kitItem) {
                        $kitItem->Product->quantity = $kitItem->Product->quantity - $item['qtd'];
                        $kitCost += $kitItem->cost;
                        $kitItem->Product->save();
                    }
                    $saleItem->item_cost = $kitCost;
                } else {
                    $saleItem->product_id = $item['id'];
                    $product = Product::find($item['id']);
                    $saleItem->item_cost = $product->cost;
                    $product->quantity = $product->quantity - $item['qtd'];
                    $product->save();
                }
                $saleItem->quantity = $item['qtd'];
                $saleItem->item_price = $item['price'];
                $saleItem->save();
            }
        }
        //Tratar pagamento parcelado com entrada
        if ($request['payment_type'] == "EP") {
            $salePayment = new SalePayment();
            $salePayment->user_id = Auth::user()->id;
            $salePayment->sale_id = $sale->id;
            $salePayment->total = $request['valor_entrada'];
            $salePayment->dth_payment = Carbon::now();
            $salePayment->payment_type = 'AV';
            $salePayment->save();
        }
        return response()->json([
            'status' => 'Venda de ID:' . $sale->id . ' registrada com sucesso!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
