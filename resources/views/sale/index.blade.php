@extends('layouts.header')
@section('content-header')
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Histórico</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                <p>{{session('status')}}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="client">Cliente</label>
                                    <select class="form-control select2" id="client">
                                        <option value="-1" selected>Selecione um cliente</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr/>
                            </div>
                            <div class="col-lg-12">
                                <table id="datatable" class="table table-bordered table-striped datatable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Forma pagamento</th>
                                        <th>Total</th>
                                        <th>Total pago</th>
                                        <th>Dia de pagamento</th>
                                        <th>Data Inicial da Cobrança</th>
                                        <th>Alterar dia de cobrança</th>
                                    </tr>
                                    </thead>
                                    <tbody class="modal-body">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar dia de vencimento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="/sale/edit/payment/day">
                                {!! csrf_field() !!}
                                <input type="hidden" name="id" id="saleid">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Valor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">ID da Venda</th>
                                        <td class="id"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dia de cobrança atual</th>
                                        <td class="dia"></td>
                                    </tr>
                                    <tr id="dth_cobranca">
                                        <th scope="row">Data Inicial de Cobrança</th>
                                        <td><input type="date" id="data_cobranca" name="data_cobranca" placeholder="01/01/2001" /></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Novo dia de cobrança</th>
                                        <td><input type="number" id="dth_payment" name="dth_payment" required placeholder="15" /></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-success edit-sale">Alterar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('scripts')
    <script>
        function EditSalePayment(id, dia, total){
            console.log(id);
            $('.id').html(id);
            $('#saleid').val(id);
            $('.dia').html(dia);

            if(total == 0){
                console.log(total);
                $('#dth_cobranca').show();
            }else{
                $('#dth_cobranca').hide();
            }
            $('#modal-default').show();
        }
        (function ($) {
            'use strict';
            $('#client').change(function (e) {
                var id = $(this).val();

                //$('#client').empty().trigger("change");
                //var newOption = new Option("Selecione um cliente.", "");
                //$('#client').append(newOption).trigger('change');
                $.ajax({
                    url: "/report/getSalesByClient/" + id,
                    method: "GET",
                    success: function (element) {

                        var table = $('#datatable').DataTable();
                        table.clear().draw();
                        var auxJson = element.sales;
                        for (let u = 0; u < auxJson.length; u++) {
                            var fullTable = "<tr> <td>"+ auxJson[u].id + "</td>";
                            fullTable +="<td>"+ auxJson[u].payment_type + "</td>";
                            fullTable +="<td>R$ "+ auxJson[u].total+ "</td>";
                            fullTable +="<td>R$ "+ auxJson[u].totalPaid + "</td>";
                            fullTable +="<td>"+ auxJson[u].payment_day    + "</td>";
                            fullTable +="<td>"+ auxJson[u].inicial_date + "</td>";
                            fullTable +="<td><a data-toggle=\"modal\" data-target=\"#modal-default\" class='edit' onclick='EditSalePayment("+auxJson[u].id+","+auxJson[u].payment_day+","+auxJson[u].totalPaid+")'><i class=\"fas fa-2x fa-pen-square\"></i></a></td>";
                            fullTable +="</td>";
                            table.row.add($(fullTable)).draw(false);
                        }
                        console.log(element);
                    },
                    error: function (element) {
                        console.log(element);
                    }
                });
            });

        })(jQuery);
    </script>
@endsection
