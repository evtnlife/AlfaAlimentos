/*
* --- Atenção metodos javascript devem ser incrementados apenas no final.
*/
(function ($) {
    'use strict';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').select2();

    //CIDADE / ESTADO - Evento geral
    $('.state').change(function () {
        var id = $(this).find('option:selected').attr('value');
        $.ajax({
            url: "/city/" + id,
            success: function (result) {
                result.city.forEach(function (item, id) {
                    var newOption = new Option(item.name, item.id, false, false);
                    $('.city').append(newOption).trigger('change');
                });
            }
        });
    });

    if($('.duallistbox'))
        $('.duallistbox').bootstrapDualListbox(
            {
                filterTextClear: 'Limpar Filtro',
                infoText: 'Total: {0}',                                                        // text when all options are visible / false for no info text
                infoTextFiltered: '<span class="label label-warning">Filtrado</span> {0} de {1}', // when not all of the options are visible due to the filter
                infoTextEmpty: 'Lista Vazia',
            }
        );

    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })


})(jQuery);
/*
* --- Atenção functions JavaScript devem ser incrementados apenas no final.
*/

