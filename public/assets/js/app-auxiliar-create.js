$(function(){

    $("#store").validate({
        ignore: [],
        rules: {
            nombre:{
                required: true
            },
            ape_pat:{
                required: true
            },
            ape_mat:{
                required: true
            },
            cod_doc_tip:{
                required: true
            },
            num_doc:{
                required: true
            }
        },
        messages: {
            nombre:{
                required: "Campo obligatorio"
            },
            ape_pat:{
                required: "Campo obligatorio"
            },
            ape_mat:{
                required: "Campo obligatorio"
            },
            cod_doc_tip:{
                required: "Campo obligatorio"
            },
            num_doc:{
                required: "Campo obligatorio"
            }
        },
        submitHandler: function(form) {

            $.ajax({
                url:'/api/auxiliares',
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
                    $(".alert").addClass(response.alert).find(".fa_icon").addClass(response.icon);

                },
                complete: function(){


                    $(form).find(".alert").hide().fadeIn().removeClass("out").addClass("in");
                    $(form).find(".save").removeAttr("disabled");
                    $('#store')[0].reset();

                },
                error: function (xhr, ajaxOptions, thrownError) {

                    if(  response.status == 500){
                        $(".message").html("Error al realizar la ficha de inscripción");
                    }

                }
            });

        }
    });

    $("#edit").validate({
        ignore: [],
        rules: {
            nombre:{
                required: true
            },
            ape_pat:{
                required: true
            },
            ape_mat:{
                required: true
            },
            cod_doc_tip:{
                required: true
            },
            num_doc:{
                required: true
            }
        },
        messages: {
            nombre:{
                required: "Campo obligatorio"
            },
            ape_pat:{
                required: "Campo obligatorio"
            },
            ape_mat:{
                required: "Campo obligatorio"
            },
            cod_doc_tip:{
                required: "Campo obligatorio"
            },
            num_doc:{
                required: "Campo obligatorio"
            }
        },
        submitHandler: function(form) {

            $.ajax({
                url:'/api/auxiliares/'+$("#id_persona").val(),
                type:'put',
                datatype: 'json',
                data: $( form ).serialize(),
                beforeSend: function(){

                    $(form).find(".save").attr("disabled", "disabled");

                },
                success:function(response)
                {
                    $(".message").html(response.message);
                    $(".alert").addClass(response.alert).find(".fa_icon").addClass(response.icon);

                },
                complete: function(){


                    $(form).find(".alert").hide().fadeIn().removeClass("out").addClass("in");
                    $(form).find(".save").removeAttr("disabled");
                    $('#edit')[0].reset();

                },
                error: function (xhr, ajaxOptions, thrownError) {

                    if(  response.status == 500){
                        $(".message").html("Error al realizar la ficha de inscripción");
                    }

                }
            });

        }
    });
});