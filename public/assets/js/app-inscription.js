/* -- Routes -- */
/*var routes = {
  inscriptions     : '/dashboard/json/inscriptions/',
};*/

/* -- App -- */
var filtro_fecha_inicio = $("#fecha_inicio");

// Mostrar lista de Inscritos
if($(".items").length){
    listInscriptions('-');
}

filtro_fecha_inicio.change(function(){
  listInscriptions($(this).val());
});

/* Edit Inscription */


if($("#id_enrollment").val()){
    showInscription(25);
}


/* -- Form Inscription -- */

// Selección de medio de pago
$("#id_payment_method").change(function(){

    var sel_form_pago = $(this).val() * 1;

    if(sel_form_pago){

        $(".content_item").hide();
        $(".content_item_"+sel_form_pago).show();
        $(".content_item_mount").show();

        // Total
        if(sel_form_pago == 1){

            $("#amount").removeAttr("readonly").focus();

        // Fraccionado
        } else if(sel_form_pago == 2){

            $("#num_cuota").focus();
            $("#amount").removeAttr("readonly");

        // Condicional
        } else if(sel_form_pago == 3){

            $("#condicional_date_1").focus();
            $("#amount").val('').attr("readonly", "readonly");

        // Becado
        } else if(sel_form_pago == 4){

            $(".content_item_mount").hide();
            $(".content_concept").hide();

        }

    } else {

        $(".content_item").hide();

    }


});


// Calculo dinamico de montos segun el medio de pago condicional
$( "#condicional_amount_1" ).keyup(function() {
    var amount = $("#amount");
    amount.val(calculateAmmountCondicional($(this).val() * 1 , $( "#condicional_amount_2" ).val() * 1 ) );
});

$( "#condicional_amount_2" ).keyup(function() {
    var amount = $("#amount");
    amount.val(calculateAmmountCondicional($(this).val() * 1, $( "#condicional_amount_1" ).val() * 1) );
});

// Concepto
$( "input[name='amount']" ).keyup(function() {

    /*var amount = $(this);
    var calculate_amount = calculateAmmountCondicional($(this).val() * 1, $( "#condicional_amount_1" ).val() * 1);
    amount.val(calculate_amount);*/

    var amount = $(this);
    // Pago Total
    if($(".concept_amount").hasClass("amount_9_1") ){
        $(".amount_9_1").val(amount.val());

    // Pago Fraccionado
    } else if( $(".concept_amount").hasClass("amount_3_2") ){
        $(".amount_3_2").val(amount.val());

    // Pago Condicional
    } else if( $(".concept_amount").hasClass("amount_3_3") ){
        $(".amount_3_3").val(amount.val());
    }

});

// Registra la forma de pago
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
            //$("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
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

function showInscription(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/inscription/show/'+id_enrollment,
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(r)
        {
            console.log(r);

            var epm_type      = r.forma_pago.id_payment_method;
            $("#id_payment_method").val(epm_type).trigger("change");

            // Fraccionado
            if(epm_type == 2){

                var epm_num_cuota = r.forma_pago.form_pago_detalle.num_cuota;
                $("#num_cuota").val(epm_num_cuota).trigger("change");

            // Condicional
            } else if(epm_type == 3){

                var epm_num_cuotas = r.forma_pago.form_pago_detalle;

                $.each( epm_num_cuotas, function(i, item) {
                    $("#condicional_date_"+item.num_cuota).val(item.date);
                    $("#condicional_amount_"+item.num_cuota).val(item.amount);
                });

            }

            var epm_amount    = r.forma_pago.form_pago_detalle.amount;
            $("#amount").val(epm_amount);

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



// Medio de Pago
function showPaymentMethodStudent(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/student/'+id_enrollment+'/payment-method/show',
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

            showConcepts(id_enrollment);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });
}

// Conceptos
function showConcepts(id_enrollment){
    $.ajax({
        url:'/hsqegroup/api/inscription/'+id_enrollment+'/concepts/show',
        type:'get',
        datatype: 'json',
        data: {},
        beforeSend: function(){

        },
        success:function(response)
        {

            var source   = $("#response-template-concepts").html();
            var template = Handlebars.compile(source);
            var html    = template(response);
            $(".content_concept_items").empty().append(html);
            $(".content_concept").show();
            console.log(response);

        },
        complete: function(){

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(response);
            /*if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }*/
        }
    });

}

// Datos de la facturación
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

function calculateAmmountCondicional(amount1, amount2){

    var calcular = (amount1 + amount2);


    if( $(".concept_amount").hasClass("amount_3_3") ){
        $(".amount_3_3").val(calcular);
    }

    return calcular;
}

function customValidate(rules, messages){
    $("#frm_payment_method_student").validate({
        ignore: [],
        errorPlacement: function(error, element) {
            if(element.attr( "id" ) == 'ley_proteccion'){
                $(".error_checkbox").show();
            } else {
                error.insertAfter(element);
            }
        },
        rules: rules,
        messages: messages,
        submitHandler: function(form) {

            $.ajax({
                url:'/hsqegroup/api/inscription/concepts/store',
                type:'post',
                datatype: 'json',
                data: $( form ).serialize(),
                beforeSend: function(){
                    $("#frm_payment_method_student").find(".done").attr("disabled", "disabled");
                },
                success:function(response)
                {

                    //console.log(response);
                    $(".message").html(response.message);

                    $(".content_concept").show();
                    showConcepts($("#id_enrollment").val());


                },
                complete: function(){
                    $("#frm_payment_method_student").find(".alert-success").show().removeClass("out").addClass("in");
                    $("#frm_payment_method_student").find(".done").removeAttr("disabled");
                },
                error: function (xhr, ajaxOptions, thrownError) {

                }
            });


        }
    });
}

function customRules(id_payment_method){
    var rules;
    if(id_payment_method == 1) {

        rules = {
            amount: {
                required: true
            }

        }

    } else if(id_payment_method == 2) {

        rules = {
            num_cuota:{
                required: true
            },
            amount: {
                required: true
            }

        }

    } else if(id_payment_method == 3) {

        rules = {
            'condicional_date[]': "required",
            'condicional_amount[]': "required",
            amount: {
                required: true
            }

        }

    }

    return rules;
}

function customMessages(id_payment_method){
    var messages;
    if(id_payment_method == 1) {

        messages = {
            amount: {
                required: "El campo es obligatorio"
            }

        }

    } else if(id_payment_method == 2) {

        messages = {
            num_cuota:{
                required: "El campo es obligatorio"
            },
            amount: {
                required: "El campo es obligatorio"
            }

        }

    } else if(id_payment_method == 3) {

        messages = {
            'condicional_date[]':{
                required: "El campo es obligatorio"
            },
            'condicional_amount[]':{
                required: "El campo es obligatorio"
            },
            amount: {
                required: "El campo es obligatorio"
            }

        }

    }

    return messages;
}