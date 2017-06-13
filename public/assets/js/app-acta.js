/**
 * Created by JUAN on 05/06/2017.
 */

$(function(){

    addListModalities();
    addListTypeEspecializations();

    $("#id_esp_tipo").change(function(){
        addListEspecialization($("#id_mod").val(), $(this).val());
    });

    $("#find").validate({
        rules: {
            id_mod:{
                required: true
            },
            id_esp_tipo:{
                required: true
            },
            id_esp:{
                required: true
            }
        },
        messages: {
            id_mod:{
                required: "Es necesario"
            },
            id_esp_tipo:{
                required: "Es necesario"
            },
            id_esp:{
                required: "Es necesario"
            }

        },
        submitHandler: function(form) {

            if (! $.fn.dataTable.isDataTable( '#datatable-responsive' ) ) {
                $('#datatable-responsive').DataTable({
                    destroy: true,
                    "ajax": '/api/groups/group-generate-acta?id_mod='+$("#id_mod").val()+'&id_type_esp='+$("#id_esp_tipo").val()+'&id_esp='+$("#id_esp").val(),
                    "columns": [
                        {"data": "id"},
                        {"data": "nom_grupo"},
                        {"data": "action"}
                    ],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "order": [[0, "asc"]],
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Sin resultados",
                        "info": "Mostrando _PAGE_ de _PAGES_",
                        "infoEmpty": "No hay registros Activos",
                        "infoFiltered": "(filtrada de _MAX_  entradas en total)",
                        "sSearch": "Buscar :",
                        "paginate": {
                            "previous": "Anterior",
                            "next": "Siguiente",
                            "first": "Inicio",
                            "last": "Final"
                        }
                    },
                    scrollX: true,
                    dom: "Bfrtip",
                    buttons: [
                        {
                            extend: "excel",
                            className: "btn btn-5 btn-5a icon-excel excel"
                        }]
                });
            }


        }
    });

});

// Lista de Modalidades
function addListModalities(){
    $.ajax({
        url:"/api/modality",
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){
            $("#id_mod").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $.each(response.response, function (i, item) {
                $("#id_mod").append($('<option>', {
                    value: item.id,
                    text : item.nom_mod
                }));
            });
            $("#id_mod").removeAttr("disabled");
        }
    });
}

// Lista de Tipo de especialización
function addListTypeEspecializations(){
    $.ajax({
        url:"/api/type-especialization",
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){
            $("#id_esp_tipo").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $.each(response.response, function (i, item) {
                $("#id_esp_tipo").append($('<option>', {
                    value: item.id,
                    text : item.nom_esp_tipo
                }));
            });
            $("#id_esp_tipo").removeAttr("disabled");
        }
    });
}

// Especialización
function addListEspecialization(id_mod, id_type_esp){
    $.ajax({
        url:"/api/especialization",
        type:'get',
        datatype: 'json',
        data:{id_mod:id_mod, id_type_esp:id_type_esp},
        beforeSend: function(){
            $("#id_esp").attr("disabled", "disabled");
        },
        success:function(response)
        {
            if(response){
                $("#id_esp").empty();
                $.each(response.response, function (i, item) {
                    $("#id_esp").append($('<option>', {
                        value: item.id,
                        text : item.nom_esp
                    }));
                });
                $("#id_esp").removeAttr("disabled");
            }

        }
    });
}
