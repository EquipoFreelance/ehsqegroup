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

if($("#id_enrollment").length){
    showInscriptionVerifyPayment($("#id_enrollment").val());
}

$( document ).delegate( "input:checkbox", "ifChanged", function(e) {

    var id;

    id = $(this).attr("id").replace("checked_", "");

    if($(this).is(':checked') == true){

        $("#enrollment_concept_verified_"+id).val(1);

    } else {

        $("#enrollment_concept_verified_"+id).val(0);

    }

});


$("#frm_edit_enrollment_payment_concept").find(".save").click(function(){
    event.preventDefault();
    $.ajax({
        url:'/hsqegroup/services/validate-payment/store',
        type:'post',
        datatype: 'json',
        data: $( "#frm_edit_enrollment_payment_concept" ).serialize(),
        beforeSend: function(){
            $("#frm_edit_enrollment_payment_concept").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            //console.log(response);
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_edit_enrollment_payment_concept").find(".alert-success").hide().fadeIn().removeClass("out").addClass("in");
            $("#frm_edit_enrollment_payment_concept").find(".save").removeAttr("disabled");

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    }).done(function(){
        location.href = document.URL;
    });
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

/***
 * Muestra los conceptos disponibles por inscripción
 * @param id_enrollment
 */
function showInscriptionVerifyPayment(id_enrollment){
    $.ajax({
        url:'/hsqegroup/services/validate-payment/show/'+id_enrollment,
        type:'get',
        datatype: 'json',
        beforeSend: function(){

        },
        success:function(r)
        {

            if(r){

                console.log(r);

                var student    = r.inscription.student;     // Información del alumno
                var enrollment = r.inscription.enrollment;  // Información de la matricula

                $("#student").val(student);
                $("#especializacion").val(enrollment.especialization);
                $("#modalidad").val(enrollment.modality);
                $("#fecha-inscription").val(enrollment.created_at);
                $("#period_academy").val(enrollment.period_academy);

                var source   = $("#response-template-concepts").html();
                var template = Handlebars.compile(source);
                var html     = template(r);
                $(".content_concept_items").empty().append(html);

                $('input.flatedit').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green',
                });



            }


        },
        complete: function(){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });
}
