@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="filters pl-3 mb-3">
                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="form-control select2 client" name="client" id="client"
                                        style="width: 100%;">
                                    <option selected="selected">Selecione um Cliente</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Compra</label>
                                <select class="form-control select2 sale" name="sale" id="sale" style="width: 100%;">
                                    <option selected="selected">Selecione uma Compra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    <p>{{session('status')}}</p>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row hide-element">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background-color: #e9ecef;">
                                    <h3 class="card-title"><b>Informações da venda</b></h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="min-width: 120px">Total</th>
                                            <th style="min-width: 120px">Custo</th>
                                            <th style="min-width: 120px">Pago</th>
                                            <th style="min-width: 120px">À pagar</th>
                                            <th style="min-width: 120px">Desconto</th>
                                            <th style="width: 100%">Tipo de Pagamento</th>
                                            <th style="min-width: 120px">Parcelas</th>
                                            <th style="min-width: 120px">Dia de Pagamento</th>
                                        </tr>
                                        </thead>
                                        <tbody class="sale-information">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hide-element">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header mb-3" style="background-color: #e9ecef;">
                                    <h3 class="card-title"><b>Relatório de pagamentos recebidos</b></h3>
                                </div>
                                <div class="card-body p-0">
                                    <table id="datatable" class="table table-bordered table-striped datatable">
                                        <thead>
                                        <tr>
                                            <th>Total pago no dia</th>
                                            <th>Dia do pagamento</th>
                                        </tr>
                                        </thead>
                                        <tbody class="payment-information">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row hide-element">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header mb-3" style="background-color: #e9ecef;">
                                    <h3 class="card-title"><b>Adicionar novo Pagamento</b></h3>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-3">
                                        <label for="totalPayment">Valor pago</label>
                                        <input type="number" id="totalPayment" name="totalPayment" class="form-control"/>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="dth_payment">Data de pagamento</label>
                                        <input type="date" id="dth_payment" class="form-control" name="dth_payment" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="payment_type">Tipo de pagamento</label>
                                        <select name="payment_type" id="payment_type" class="form-control">
                                            <option value="AV">Dinheiro</option>
                                            <option value="CC">Cartão de Crédito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-1">
                                    <div class="col-lg-3">
                                        <button data-toggle="modal" data-target="#modal-default" onclick="confirmation()" class="btn btn-dark">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b><p>Deseja Realmente adicionar este pagamento?</p></b>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <form method="post" action="/add/payment">
                            {!! csrf_field() !!}
                            <input type="hidden" name="user_id" id="user_id">
                            <input type="hidden" name="sale_id" id="sale_id">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="rest" id="rest">
                            <input type="hidden" name="dth_payment" id="dth_payment_">
                            <input type="hidden" name="payment_type" id="payment_type_">
                            <button onclick="teste()" type="submit" class="btn btn-success delete-branch">Confirmar</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let restPayment = 0;
        function confirmation(){
            $('#user_id').val($('#client').val());
            $('#sale_id').val($('#sale').val());
            $('#total').val($('#totalPayment').val());
            $('#rest').val(restPayment);
            $('#dth_payment_').val($('#dth_payment').val());
            $('#payment_type_').val($('#payment_type').val());
        }
        (function ($) {
            'use strict';
            function formatDate(dateString) {
                var dateAux = dateString.split(/\-|\s/);
                var newDate = dateAux[2] + "/" + dateAux[1] + "/" + dateAux[0];
                return newDate;
            }
            var arrayElements = [];
            $('.client').change(function (e) {

                var client = $('#client').val();
                $.ajax({
                    url: "/sale/payment/debts/" + client,
                    method: "GET",
                    success: function (element) {
                        console.log(element);
                        arrayElements = element.sales;
                        var selectbox = $('#sale');
                        selectbox.find('option').remove();
                        var option = '<option>Selecione uma compra</option>';
                        $.each(element.sales, function (i, obj) {
                            if(obj.StatusPagamento=="PENDENTE"){
                                option += '<option value="' + obj.id + '">' + obj.payment_type + " | " + formatDate(obj.created_at) + " | " + obj.total + '</option>';
                            }
                        });
                        $('#sale').html(option).show();
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });
            function convertDate(date){
                var dateAux = new Date(date);
                var FormatedDate= dateAux.getDate()+"/"+(dateAux.getMonth()+1)+"/"+dateAux.getFullYear();
                return FormatedDate;
            }
            $('.sale').change(function (e) {
                $('.hide-element').show();
                var sale = $('#sale').val();
                $.ajax({
                    url: "/sale/payment/debts/information/" + sale,
                    method: "GET",
                    success: function (element) {
                        console.log(element);
                        let fullTable = '';
                        $.each(element.information, function (i, obj) {
                            restPayment = obj.restUnformated;
                            fullTable = ' <tr><td>R$' + obj.total + '</td>\n' +
                                '<td>R$' + obj.cost + '</td>\n' +
                                '<td>R$' + obj.totalPayed + '</td>\n' +
                                '<td>R$' + obj.rest + '</td>\n' +
                                '<td>R$' + obj.discount + '</td>\n' +
                                '<td>' + obj.payment_type + '</td>\n' +
                                '<td>' + obj.qtd_parcels + '</td>\n' +
                                '<td>' + obj.payment_day + '</td></tr>';
                        });
                        $('.sale-information').html(fullTable);

                        var table = $('#datatable').DataTable();
                        table.clear().draw();

                        var auxJson = element.information[0].informationsPayment;
                        for (let u = 0; u < auxJson.length; u++) {
                            fullTable = "<tr> <td>R$"+ auxJson[u].total + "</td>";
                            fullTable +="<td>"+ convertDate(auxJson[u].data) + "</td>";
                            fullTable +="</td>";
                            table.row.add($(fullTable)).draw(false);
                        }
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
