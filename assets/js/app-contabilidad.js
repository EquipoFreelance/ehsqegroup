if($(".items").length){
    listInscriptions();
}
/*
* Enrollments Lists
*/
function listInscriptions(){
    if (! $.fn.dataTable.isDataTable( '#datatable-responsive' ) ) {
        $('#datatable-responsive').DataTable({
            //destroy: true,
            "ajax": '/api/contabilidad?q=ALL',
            "columns": [
                { "data": "idx" },
                { "data": "creationDate" },
                { "data": "businessExecutive" },
                { "data": "dni" },
                { "data": "firstName" },
                { "data": "lastName" },
                { "data": "email" },
                { "data": "cellphone" },
                { "data": "typeDocPyament" },
                { "data": "ruc" },
                { "data": "empresa" },
                { "data": "modality" },
                { "data": "type_specialty" },
                { "data": "specialty" },
                { "data": "periodAcademic" },
                { "data": "formaDePago" },
                { "data": "contado" },
                { "data": "cuota1" },
                { "data": "matricula" },
                { "data": "certificado" },
                { "data": "numCuotas" },
                { "data": "button_verify_payment" },
                { "data": "button_view_ficha" }
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[ 0, "asc" ],[ 1, "asc" ]],
            columnDefs: [
                /*{
                    "targets": [ 0,1 ],
                    "orderData": [ 0,1 ],
                },*/
                {
                    "targets": [ 10 ],
                    "visible": false
                }
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
}
