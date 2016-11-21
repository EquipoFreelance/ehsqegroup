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


// List Inscription
if($("#id_enrollment").val()){
    showInscription($("#id_enrollment").val());
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
            $("#amount").attr("readonly", "readonly");

        // Becado
        } else if(sel_form_pago == 4){

            $("#amount").val(0);
            $(".content_item_mount").hide();
            $(".content_concept").hide();

        }

        //$.removeData(,'validator');
        $("#frm_payment_method_student").unbind().removeData();
        $("label.error").remove();
        $("input.error").removeClass("error");
        customValidate(customRules(sel_form_pago), customMessages(sel_form_pago));

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

$( "input[name='amount']" ).keyup(function() {

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

/* -- Form Request -- */

// Registra la forma de pago
$("#frm_payment_method_studentxxx").find(".save").click(function(){
    event.preventDefault();
    $.ajax({
        url:'/hsqegroup/services/inscription/store/payment-method',
        type:'post',
        datatype: 'json',
        data: $( "#frm_payment_method_student" ).serialize(),
        beforeSend: function(){
            $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_payment_method_student").find(".alert-success").hide().fadeIn().removeClass("out").addClass("in");
            $("#frm_payment_method_student").find(".save").removeAttr("disabled");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            if(  response.status == 400){
                $("#frm_payment_method_student").find(".save").attr("disabled", "disabled");
            }
        }
    });

});

// Registrar datos de la facturación
$("#frm_billing_client").find(".save").click(function(){

    event.preventDefault();

    $.ajax({
        url:'/hsqegroup/services/inscription/store/billing-client',
        type:'post',
        datatype: 'json',
        data: $( "#frm_billing_client" ).serialize()+"&id_enrollment="+$("#id_enrollment").val(),
        beforeSend: function(){
            $("#frm_billing_client").find(".save").attr("disabled", "disabled");
        },
        success:function(response)
        {
            $(".message").html(response.message);
        },
        complete: function(){
            $("#frm_billing_client").find(".alert-success").hide().fadeIn().removeClass("out").addClass("in");
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

// Inscription Lists
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

// Show Inscription
function showInscription(id_enrollment){
    $.ajax({
        url:'/hsqegroup/services/inscription/show/'+id_enrollment,
        type:'get',
        datatype: 'json',
        beforeSend: function(){

        },
        success:function(r)
        {

            if(r){

                console.log(r);

                if(r.forma_pago){

                    var form_pago_detalle = r.forma_pago.form_pago_detalle; // Detalle de la forma de pago
                    var epm_type          = r.forma_pago.id_payment_method; // Tipo de forma de pago

                    // Forma de Pago
                    if(form_pago_detalle){

                        $("#id_payment_method").val(epm_type).trigger("change");

                        // Fraccionado
                        if(epm_type == 2){

                            var epm_num_cuota = form_pago_detalle.num_cuota;
                            $("#num_cuota").val(epm_num_cuota).trigger("change");

                            // Otros Pagos (Matricula, Certificado)
                            if(form_pago_detalle.other_concepts){
                                $.each( form_pago_detalle.other_concepts, function(i, item) {

                                    // Matricula
                                    if(item.id_concept == 1){

                                        $("#amount_enrollment_id").val(item.id);
                                        $("#amount_enrollment").val(item.amount);

                                        // Certificado
                                    } else if(item.id_concept == 2){

                                        $("#amount_certificate_id").val(item.id);
                                        $("#amount_certificate").val(item.amount);

                                    }

                                });
                            }


                            // Condicional
                        } else if(epm_type == 3){

                            $.each( form_pago_detalle, function(i, item) {
                                $("#condicional_date_"+item.num_cuota).val(item.date);
                                $("#condicional_amount_"+item.num_cuota).val(item.amount);
                            });

                        }

                        var epm_amount    = r.forma_pago.amount;
                        $("#amount").val(epm_amount);

                    }

                    $("#observation").val(r.forma_pago.observation);
                }


                if(r.billing_client){

                    var billing_client    = r.billing_client;    // Detalle de la forma de pago

                    // Datos de la facturación
                    if(billing_client){

                        $("#billing_razon_social").val(billing_client.razon_social);
                        $("#billing_ruc").val(billing_client.ruc);
                        $("#billing_phone").val(billing_client.phone);
                        $("#billing_address").val(billing_client.address);
                        $("#billing_client_firstname").val(billing_client.client_firstname);
                        $("#billing_client_lastname").val(billing_client.client_lastname);

                    }

                }

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
                url:'/hsqegroup/services/inscription/store/payment-method',
                type:'post',
                datatype: 'json',
                data: $( form ).serialize(),
                beforeSend: function(){
                    $(form).find(".save").attr("disabled", "disabled");
                },
                success:function(response)
                {
                    $(".message").html(response.message);
                },
                complete: function(){
                    $(form).find(".alert-success").hide().fadeIn().removeClass("out").addClass("in");
                    $(form).find(".save").removeAttr("disabled");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(  response.status == 400){
                        $(form).find(".save").attr("disabled", "disabled");
                    }
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
                required: true,
                min: 1
            }

        }

    } else if(id_payment_method == 2) {

        rules = {
            num_cuota:{
                required: true
            },
            amount_enrollment: {
                required: true,
                min: 1
            },
            amount_certificate : {
                required: true,
                min: 1
            },
            amount: {
                required: true,
                min: 1
            }

        }

    } else if(id_payment_method == 3) {

        rules = {
            amount: {
                required: true,
                min: 1
            },
            'condicional_date[0]':{
                required: true
            },
            'condicional_date[1]':{
                required: true
            },
            'condicional_amount[0]': {
                required: true
            },
            'condicional_amount[1]': {
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
                required: "El campo es obligatorio",
                min: "Valor mínimo 1"
            }

        }

    } else if(id_payment_method == 2) {

        messages = {
            num_cuota:{
                required: "El campo es obligatorio"
            },
            amount_enrollment: {
                required: "El campo es obligatorio",
                min: "Valor mínimo 1"
            },
            amount_certificate : {
                required: "El campo es obligatorio",
                min: "Valor mínimo 1"
            },
            amount: {
                required: "El campo es obligatorio",
                min: "Valor mínimo 1"
            }

        }

    } else if(id_payment_method == 3) {

        messages = {
            amount: {
                required: "El campo es obligatorio",
                min: "Valor mínimo 1"
            },
            'condicional_date[0]':{
                required: "El campo es obligatorio"
            },
            'condicional_date[1]':{
                required: "El campo es obligatorio"
            },
            'condicional_amount[0]':{
                required: "El campo es obligatorio"
            },
            'condicional_amount[1]':{
                required: "El campo es obligatorio"
            }

        }

    }



    return messages;
}