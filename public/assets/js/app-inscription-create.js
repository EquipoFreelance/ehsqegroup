$(function(){

    $("#store").validate({
        ignore: [],
        errorPlacement: function(error, element) {
            if(element.attr( "id" ) == 'ley_proteccion'){
                $(".error_checkbox").show();
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            id_academic_period:{
                required: true
            }

        },
        messages: {
            id_academic_period:{
                required: "Es necesario"
            }

        },
        submitHandler: function(form) {

            $.ajax({
                url:'/api/inscriptions',
                type:'post',
                datatype: 'json',
                data: $( form ).serialize(),
                beforeSend: function(){

                    $(form).find(".save").attr("disabled", "disabled");

                },
                success:function(response)
                {
                    console.log(response);
                    $(".message").html(response.message);

                },
                complete: function(){

                    $(form).find(".alert-success").hide().fadeIn().removeClass("out").addClass("in");
                    $(form).find(".save").removeAttr("disabled");
                    $('#store')[0].reset();

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    
                    if(  response.status == 500){
                        $(".message").html("Error al realizar la ficha de inscripción");
                    }

                }
            });

            //console.log("Hola mundo");

        }
    });

});