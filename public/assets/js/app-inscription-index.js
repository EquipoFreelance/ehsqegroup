
$(function(){

    var ajax_default = '/api/inscriptions?created_by='+$("#created_by").val();

    listInscriptions(ajax_default);

    if($('#date_from').length){
        $('#date_from').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'YYYY-MM-DD', lang : 'es'});
    }
    if($('#date_to').length){
        $('#date_to').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'YYYY-MM-DD', lang : 'es'});
    }

});

$(function(){
    
    $("#filter").click(function(e){

        e.preventDefault();

        var ajax_default = '/api/inscriptions?created_by='+$("#created_by").val()+'&date_from='+$("#date_from").val()+'&date_to='+$("#date_to").val();

        console.log(ajax_default);

        listInscriptions(ajax_default);

    });  
});


/* -- Customs Functions --*/

// Inscription Lists
function listInscriptions(url_ajax){

    //if (! $.fn.dataTable.isDataTable( '#datatable-responsive' ) ) {
        var table = $('#datatable-responsive').DataTable({
            destroy: true,
            "ajax": url_ajax,
            "columns": [
                { "data": "idx" },
                { "data": "student" },
                { "data": "email" },
                { "data": "createdAt" },
                { "data": "periodAcademic" },
                { "data": "creationDate" },
                { "data": "typeSpecialty" },
                { "data": "specialty" },
                { "data": "modality" },
                { "data": "buttonEditar" }
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[ 0, "asc" ],[ 3, "asc" ]],
            columnDefs: [
                /*{
                    "targets": [ 0,3 ],
                    "orderData": [ 0,3 ],
                }*/
                /*,
                {
                    "targets": [ 10 ],
                    "visible": false
                }*/
            ],
            "language":
            {
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
                }],
        });


}
