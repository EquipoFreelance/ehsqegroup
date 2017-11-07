
/* -- App Students -- */
$(function(){
  if($('#fe_nacimiento').length > 0){
    $('#fe_nacimiento').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
  }
});


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

/*
 * Lista de Alumnos Asignados al Grupo
 * */
function listAssignedStudents(cod_grupo){

    var source   = '<tr><td colspan="2"><center>{{ message }}</center></td></tr>';
    var template = Handlebars.compile(source);
    var html     = template({message: "Loading..."});

    $.ajax({
        url:'/hsqegroup/api/groups/'+cod_grupo+'/students',
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){
            $(".items").empty().append(html);
        },
        success:function(response)
        {
            var source   = $("#response-template").html();
            var template = Handlebars.compile(source);
            var html     = template(response);
            $(".items").empty().append(html);
        },
        error:function(response)
        {
            if(  response.status == 400){
                var source   = '<tr><td colspan="2"><center>{{ message }}</center></td></tr>';
                var template = Handlebars.compile(source);
                var html    = template(response.responseJSON);
                $(".items").empty().append(html);
            }
        }
    }).done(function(data){

    });
}

/*
* Búsqueda de alumnos
* @param string group  Id del grupo
* @param string search nonbre, apellido del alumnos
* @return response json
* */
function listStudentsSearch(group, search){

    var source   = '<tr><td colspan="3"><center>{{ message }}</center></td></tr>';
    var template = Handlebars.compile(source);
    var html     = template({message: "Loading..."});

    $.ajax({
        url:'/hsqegroup/api/groups/students/search/'+group+'/'+ search,
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){
            $(".modal_items").empty().append(html);
        },
        success:function(r)
        {

            if(r.response == ''){
                $(".modal_items").empty().append('<tr><td colspan="3"><center>Empty</center></td></tr>');
            } else {

                source   = $("#response-template-1").html();
                template = Handlebars.compile(source);
                html     = template(r);

                $(".modal_items").empty().append(html);
            }

        },
        error:function(response)
        {
            $(".modal_items").empty().append('<tr><td colspan="3"><center>Error</center></td></tr>');
        }
    });
}
/*
 * Almacena los alumnos seleccionados
 * @param string params varios parametros del formulario(cod_grupo, students)
 * @return response json
 * */
function storeAssignGroup(params, obj){
    $.ajax({
        url:'/hsqegroup/api/groups/students/assign',
        type:'post',
        datatype: 'json',
        data:params,
        beforeSend: function(){
            obj.attr("disabled", "disabled");
        },
        success:function(r)
        {
            obj.removeAttr("disabled");
        },
        complete: function(){
            listAssignedStudents(params[1].value, '-');
        },
        error:function(r)
        {

        }
    });
}