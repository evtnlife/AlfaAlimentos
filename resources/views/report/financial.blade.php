@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Dados contábeis</h3>
                    </div>
                    <div class="card-body">
                        <div class="filters pl-3 mb-3">
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="InicialDate">Data de Início</label>
                                        <input class="filter form-control" type="date" id="InicialDate" name="dth_ini"
                                               value="01/01/2020"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="EndDate">Data Final</label>
                                        <input class="filter form-control" type="date" id="EndDate" name="dth_end"
                                               value="01/01/2020"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Status Pagamento</label>
                                        <select class="filter form-control select2" name="status" id="status"
                                                style="width: 100%;">
                                            <option value="-1" selected="selected">Selecione uma status</option>
                                            <option value="PENDENTE">Pendente</option>
                                            <option value="PAGO">Pago</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Clientes</label>
                                        <select class="form-control filter select2" name="client" id="client"
                                                style="width: 100%;">
                                            <option value="-1" selected="selected">Selecione um cliente</option>
                                            @foreach($client as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <table id="datatable" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>Venda ID</th>
                                <th>Cliente</th>
                                <th>Preço Custo</th>
                                <th>Preco Venda</th>
                                <th>Total Pago</th>
                                <th>Data Venda</th>
                            </tr>
                            </thead>
                            <tbody class="sale-data">
                            </tbody>
                        </table>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>Dados finais</h3>
                            </div>
                            <div class="col-lg-4">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Valor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Custo Total</th>
                                        <td class="total_cost"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total de Vendas</th>
                                        <td class="total_sale"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Pago</th>
                                        <td class="total_paid"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function ($) {
            'use strict'
            $(document).ready(function () {
                $('.filter').trigger('change');
            });
            function SaleTableToArray() {
                let saleList = [];
                $('.sale-data > tr').each(function (index, value) {
                    let sale = {
                        id: 0,
                        client: '',
                        total_cost: 0,
                        total_sale: 0,
                        total_paid: 0
                    };
                    let counter = 0;
                    $(this).find('td').each(function () {
                        switch (counter++) {
                            case 0:
                                sale.id = $(this).text();
                                break;
                            case 1:
                                sale.client = $(this).text();
                                break;
                            case 2:
                                sale.total_cost = $(this).text();
                                break;
                            case 3:
                                sale.total_sale = $(this).text();
                                break;
                            case 4:
                                sale.total_paid = $(this).text();
                                break;
                        }
                    });
                    saleList.push(sale);

                });
                return saleList;
            }
            function convertDate(date){
                var dateAux = new Date(date);
                var FormatedDate= dateAux.getDate()+"/"+(dateAux.getMonth()+1)+"/"+dateAux.getFullYear();
                return FormatedDate;
            }
            $('.filter').change(function (e) {
                let dados = {
                    dth_ini: $('#InicialDate').val(),
                    dth_fim: $('#EndDate').val(),
                    status: $('#status').val(),
                    payment_type: $('#payment_type').val(),
                    client: $('#client').val()
                };
                $.ajax({
                    url: "/report/getSalesByFilters",
                    data: dados,
                    method: "GET",
                    success: function (element) {
                        var table = $('#datatable').DataTable();
                        table.clear().draw();

                        var auxJson = element.sales;
                        for (let u = 0; u < auxJson.length; u++) {
                            var fullTable = "<tr> <td>" + auxJson[u].id + "</td>";
                            fullTable += "<td>" + auxJson[u].name + "</td>";
                            fullTable += "<td>" + auxJson[u].cost + "</td>";
                            fullTable += "<td>" + auxJson[u].total + "</td>";
                            fullTable += "<td>" + auxJson[u].totalPaid + "</td>";
                            fullTable += "<td>" + convertDate(auxJson[u].created_at) + "</td>";
                            fullTable += "</td>";
                            table.row.add($(fullTable)).draw(false);
                        }
                        let sales = SaleTableToArray();
                        let total_cost = 0;
                        let total_sale = 0;
                        let total_paid = 0;
                        console.log(sales);
                        $.each(sales, function () {
                            total_cost += parseFloat(this.total_cost);
                            total_sale += parseFloat(this.total_sale);
                            total_paid += parseFloat(this.total_paid);
                        });

                        $('.total_cost').text("R$ " + total_cost);
                        $('.total_sale').text('R$ ' + total_sale);
                        $('.total_paid').text('R$ ' + total_paid);
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
