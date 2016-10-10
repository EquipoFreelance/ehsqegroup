/* -- Routes -- */
/*var routes = {
  inscriptions     : '/dashboard/json/inscriptions/',
};*/

/* -- App -- */
var filtro_fecha_inicio = $("#fecha_inicio");


if($(".items").length){
    listInscriptions('-');
}

filtro_fecha_inicio.change(function(){
  listInscriptions($(this).val());
});

/* -- Form Inscription -- */
$("#way_to_pay").change(function(){

    var c = $(this).val() * 1;

    $(".content_p").hide();
    $(".content_cuotas").hide();

    $(".content_"+c).show();
    $(".coutas_"+c).show();

    $("#ddlViewBy option:selected").text();
    $(".concept").html( $("option:selected", this).text() );
    
});


/* -- Customs Functions --*/

/*
* Enrollments Lists
*/
function listInscriptions(fecha_inicio){
  $.ajax({
     url:'/dashboard/json/inscriptions/'+fecha_inicio,
     type:'get',
     datatype: 'json',
     data:{},
     beforeSend: function(){
       GridbeforeSend();
     },
     success:function(response)
     {
        GridSuccess(response);
        console.log(response);
     },
     error:function(response)
    {
      if(  response.status == 400){
        GridError(response);
      }
    }
  }).done(function(data){
    if (! $.fn.dataTable.isDataTable( '#datatable-responsive' ) ) {
      $('#datatable-responsive').DataTable({
          destroy: true,
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          "order": [[ 1, "desc" ]],
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
          dom: "Bfrtip",
          buttons: [
            {
              extend: "excel",
              className: "btn btn-5 btn-5a icon-excel excel"
            }, {
              extend: "pdf",
              className: "btn btn-5 btn-5a icon-pdf pdf"
            }, {
              extend: "print",
              text:"Imprimir",
              className: "btn btn-5 btn-5a icon-print print"
            }],
          });
    }

    });
}
