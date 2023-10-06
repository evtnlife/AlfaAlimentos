@extends('layouts.header')

@section('content-header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Relatório de Cobranças de Clientes</h3>
                    </div>
                    <div class="card-body">
                        <div class="filters pl-3 mb-3">
                            <div class="row pt-3">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="InicialDate">Data de Início</label>
                                        <input class="date-picker form-control" type="date" id="InicialDate" name="InicialDate"
                                               value="01/01/2020"/>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="EndDate">Data Final</label>
                                        <input class="date-picker form-control" type="date" id="EndDate" name="EndDate"
                                               value="01/01/2020"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <table id="datatable" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Data</th>
                                <th>Parcela</th>
                                <th>Total</th>
                                <th>Valor Parcela</th>
                                <th>Endereço</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>

                                <th>Cliente</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Data</th>
                                <th>Parcela</th>
                                <th>Total</th>
                                <th>Valor Parcela</th>
                                <th>Endereço</th>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function ($) {
            'use strict';
            function convertDate(date){
                var dateAux = new Date(date);
                var FormatedDate= dateAux.getDate()+"/"+(dateAux.getMonth()+1)+"/"+dateAux.getFullYear();
                return FormatedDate;
            }
            $('.date-picker').change(function(e) {
               var InicialDate = $('#InicialDate').val();
               var EndDate = $('#EndDate').val();

               if(InicialDate != "" && EndDate != ""){
                   $.ajax({
                       url: "/report/getListClientByDate/" + InicialDate+"/"+EndDate,
                       method: "GET",
                       success: function (element) {
                           console.log(element);
                           var table = $('#datatable').DataTable();
                           table.clear().draw();
                           var auxJson = element.clients;
                           for (let u = 0; u < auxJson.length; u++) {
                                var fullTable = "<tr> <td>"+ auxJson[u].nome + "</td>";
                                 fullTable +="<td>"+ auxJson[u].telefone + "</td>";
                               fullTable +="<td>"+ auxJson[u].email+ "</td>";
                               fullTable +="<td>"+ new Date(auxJson[u].data).toLocaleDateString() + "</td>";
                               fullTable +="<td>"+ auxJson[u].parcela + "</td>";

                               fullTable +="<td> R$"+ auxJson[u].total + "</td>";
                               fullTable +="<td> R$"+ auxJson[u].valorParcela + "</td>";
                               fullTable +="<td>"+ auxJson[u].endereco + "</td>";
                               fullTable +="</td>";
                               table.row.add($(fullTable)).draw(false);
                           }
                           console.log(element);
                       },
                       error: function (element) {
                           console.log(element);
                       }
                   });
                   console.log(InicialDate+" "+EndDate);
               }
            });
        })(jQuery);
    </script>
@endsection
