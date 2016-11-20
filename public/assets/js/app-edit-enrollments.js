/***
 * Muestra los conceptos disponibles para la matricula
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

                var source   = $("#response-template-concepts").html();
                var template = Handlebars.compile(source);
                var html     = template(r);
                $(".content_concept_items").empty().append(html);

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