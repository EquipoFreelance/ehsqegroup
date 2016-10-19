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

/* Edit Inscription */


if($("#id_enrollment").val()){
    showPaymentMethodStudent($("#id_enrollment").val());
    showEnrollmentBillingClient($("#id_enrollment").val());
}


/* -- Form Inscription -- */

// Selección de medio de pago
$("#id_payment_method").change(function(){

    var c = $(this).val() * 1;

    $(".content_payment_method_student").show();
    $(".content_p").hide();
    $(".content_cuotas").hide();

    $(".content_"+c).show();
    $(".coutas_"+c).show();

    $("#ddlViewBy option:selected").text();
    $(".concept").html( $("option:selected", this).text() );

});

$("#frm_payment_method_student").find(".save").click(function(){

    event.preventDefault();

    $.ajax({
        url:'/hsqegroup/api/student/payment-method/store',
        type:'post',
        datatype: 'json',
        data: $( "#frm_payment_method_student" ).serialize(),
        beforeSend: function(){

            //$("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_payment_method_student").find(".alert-success").show().removeClass("out").addClass("in");
            $("#frm_payment_method_student").find(".save").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });

});

$("#frm_billing_client").find(".save").click(function(){

    event.preventDefault();

    $.ajax({
        url:'/hsqegroup/api/inscription/billing_client/store',
        type:'post',
        datatype: 'json',
        data: $( "#frm_billing_client" ).serialize()+"&id_enrollment="+$("#id_enrollment").val(),
        beforeSend: function(){
            $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_billing_client").find(".alert-success").show().removeClass("out").addClass("in");
            $("#frm_billing_client").find(".save").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_billing_client").find(".save").attr("disabled", "disabled");
            }
        }
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

function showPaymentMethodStudent(id_student){
    $.ajax({
        url:'/hsqegroup/api/student/'+id_student+'/payment-method/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            $("#id_payment_method").val(response.id_payment_method).trigger("change");
            $("#amount").val(response.amount);
            $("#observation").val(response.observation);

            // Fraccionado
            if(response.id_payment_method == 2){
                
                $("#num_cuota").val(response.fraccionado.num_cuota).trigger("change");

            // Condicional
            } else if (response.id_payment_method == 3) {

                $.each( response.condicional, function(i, item) {
                    $("#condicional_date_"+item.num_cuota).val(item.date);
                    $("#condicional_amount_"+item.num_cuota).val(item.amount);
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

function showEnrollmentBillingClient(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/inscription/'+id_enrollment+'/billing_client/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            console.log(response);
            
            $("#billing_razon_social").val(response.razon_social);
            $("#billing_ruc").val(response.ruc);
            $("#billing_address").val(response.address);
            $("#billing_phone").val(response.phone);
            $("#billing_client_firstname").val(response.client_firstname);
            $("#billing_client_lastname").val(response.client_lastname);

        },
        complete: function(){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                //$("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });
}