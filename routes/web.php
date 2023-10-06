<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
//Regra de aplicação de cookie.
Route::get('/', function (){
    if(isset(Auth::user()->branch_id))
    {
        if(!\Illuminate\Support\Facades\Cookie::get('branch_id') || !Auth::user()->admin)
            return redirect('/schedule')->withCookie(cookie('branch_id', Auth::user()->branch_id, 50000));
    }
    return redirect('/schedule');
});

// ------------- Rotas JSON
//Cidade
Route::get('/city/{id}', 'CityController@show');

//Products
Route::get('/api/product/category/{id}', 'CategoryController@getProductsFromCategory');
Route::get('/api/product/{id}', 'ProductController@getProductFromId');
Route::get('/api/kit/all', 'KitController@getAllKits');
Route::get('/api/kit/{id}', 'KitController@getKitFromId');

//Vender
Route::post('/api/sale', 'SaleController@store');

//Agenda
Route::get('/api/schedule', 'SalePaymentController@getCalendar');

//Client
Route::get('/api/client/list', 'ClientController@getClients');

// -------------- End Rotas JSON
//Rotas de clientes
Route::post('/client/create', 'ClientController@store');
Route::get('/client/create', 'ClientController@create');
Route::get('/client/list', 'ClientController@index');
Route::get('/client/edit/{id}', 'ClientController@edit');
Route::post('/client/edit', 'ClientController@update');
Route::post('/client/delete', 'ClientController@destroy');


//Rotas de Filiais
Route::get('/branch/list', 'BranchController@index');
Route::get('/branch/create', 'BranchController@create');
Route::get('/branch/edit/{id}', 'BranchController@edit');
Route::post('/branch/edit', 'BranchController@update');
Route::post('/branch/create', 'BranchController@store');
Route::post('/branch/change', 'BranchController@change');
Route::post('/branch/delete/{id}', 'BranchController@destroy');
Route::get('/branch/listAjax', 'BranchController@listAjax');


//Rotas de Produtos
Route::post('/product/create', 'ProductController@store');
Route::get('/product/create', 'ProductController@create');
Route::get('/product/list', 'ProductController@index');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/edit', 'ProductController@update');
Route::post('/product/delete', 'ProductController@destroy');
Route::get('/product/damaged', 'ProductController@damaged');
Route::post('/product/damaged/store', 'ProductController@damagedStore');
Route::get('/report/product/damaged/list', 'ProductController@damagedList');

//Rotas de Usuarios
Route::get('/user/list', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::get('/user/edit/{id}', 'UserController@edit');
Route::post('/user/create', 'UserController@store');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@destroy');
Route::get('/user/edit', 'UserController@edit');

//Rotas de Fornecedores
Route::get('/provider/list', 'ProviderController@index');
Route::get('/provider/create', 'ProviderController@create');
Route::get('/provider/edit/{id}', 'ProviderController@edit');
Route::post('/provider/create', 'ProviderController@store');
Route::post('/provider/edit', 'ProviderController@update');
Route::post('/provider/delete', 'ProviderController@destroy');
Route::post('/provider/quantityAdd', 'ProviderController@quantityAdd');
Route::get('/provider/entry', 'ProviderController@entry');
Route::get('/provider/getQuantity/{id}', 'ProviderController@getQuantity');
//Rotas agenda
Route::get('/schedule', 'SalePaymentController@index');

//Vender
Route::get('/sale', 'SaleController@create');
Route::get('/sale/payment', 'SalePaymentController@payment');
Route::get('/sale/payment/debts/{client}', 'SalePaymentController@getSales');
Route::get('/sale/payment/debts/information/{sale}','SalePaymentController@getSalesInformations');
Route::post('/add/payment', 'SalePaymentController@addPayment');
Route::post('/sale/edit/payment/day', 'SaleController@EditPaymmentDay');

//Rotas de kits
Route::get('/kit/create','KitController@create');
Route::get('/kit/list', 'KitController@index');
Route::get('/kit/edit/{id}', 'KitController@edit');
Route::post('/kit/create', 'KitController@store');
Route::post('/kit/edit','KitController@update');
Route::post('/kit/delete','KitController@destroy');

//Category
Route::get('/category/create', 'CategoryController@create');//Rota Get abrir janela de criar categoria /category/create
Route::post('/category/create','CategoryController@store');//Rota Post enviar requisição da janela anterior para a controller /category/create
Route::get('/category/list','CategoryController@index');//Rota get abrir lista de categorias /category/list
Route::get('/category/edit/{id}','CategoryController@edit');//Rota get abrir janela de editar categoria /category/edit/{id}
Route::post('/category/edit','CategoryController@update');//Rota post enviar requisição de update para a controller
Route::post('/category/delete','CategoryController@destroy');//Rota post de deletar os dados

//Relatórios
Route::get('/report/financial','ReportController@financial');
Route::get('/report/collection/client','ReportController@clientCollection');
Route::get('/report/getListClientByDate/{InicialDate}/{EndDate}','ReportController@getListClientByDate');
Route::get('/report/getSalesByFilters','ReportController@getSalesByFilters');
Route::get('/report/sales', 'SaleController@index');
Route::get('/report/getSalesByClient/{id}', 'SaleController@getSalesByClient');

