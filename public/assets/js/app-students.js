/* -- Routes -- */
/*var routes = {
  student     : '/hsqegroup/api/students',
};*/

/* -- App Students -- */
$(function(){
  if($('#fe_nacimiento').length){
    $('#fe_nacimiento').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
  }
});



/*filtro_fecha_inicio.change(function(){
  listEnrollments($(this).val());
});*/


/* -- Customs Functions --*/

/*
* Enrollments Lists
*/
function listStudents(){
  $.ajax({
     url:'/hsqegroup/api/students',
     type:'get',
     datatype: 'json',
     data:{},
     beforeSend: function(){
       GridbeforeSend();
     },
     success:function(response)
     {
        GridSuccess(response);
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
