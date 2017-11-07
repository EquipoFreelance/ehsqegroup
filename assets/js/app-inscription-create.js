$(function(){


    /**
     * Created by JUAN on 18/09/2016.
     */
    // Init JS Plugin Material Date Picker
    $(function(){
        if($('#id_academic_period_txt').length){
            $('#id_academic_period_txt').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
        }
    });

    //formValidate(true);

    $("#store").validate({
        ignore: [],
        errorPlacement: function(error, element) {

            if(element.attr( "id" ) == 'proteccion_datos'){

                $(".error_checkbox").show();
                //console.log("dddd");
                $("label.error").attr("style", "display:block !important");

            } else {

                error.insertAfter(element);
                $(" .chkContent label").attr("style", "display:block !important");
            }
        },
        rules: {

            id_academic_period:{
                required: true
            },
            cod_modalidad:{
                required: true
            },
            cod_esp_tipo:{
                required: true
            },
            cod_esp:{
                required: true
            },
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
                required: true,
                number:true
            },
            correo:{
                required: true,
                email: true
            },
            cod_pais: {
                required: true
            },
            cod_dpto: {
                required: true
            },
            cod_prov: {
                required: true
            },
            cod_dist: {
                required: true
            },
            direccion:{
                required: true
            },
            num_cellphone:{
                required: true
            },
            num_phone:{
                required: true
            },
            poll:{
                required: true
            },
            proteccion_datos:{
                required: true
            }

        },
        messages: {
            id_academic_period:{
                required: "Es necesario"
            },
            cod_modalidad:{
                required: "Es necesario"
            },
            cod_esp_tipo:{
                required: "Es necesario"
            },
            cod_esp:{
                required: "Es necesario"
            },
            nombre:{
                required: "Es necesario"
            },
            ape_pat:{
                required: "Es necesario"
            },
            ape_mat:{
                required: "Es necesario"
            },
            cod_doc_tip:{
                required: "Es necesario"
            },
            num_doc:{
                required: "Es necesario",
                number:"Es necesario"
            },
            correo:{
                required: "Es necesario",
                email: "Es necesario que sea un correo electrónico"
            },
            cod_pais: {
                required: "Es necesario"
            },
            cod_dpto: {
                required: "Es necesario"
            },
            cod_prov: {
                required: "Es necesario"
            },
            cod_dist: {
                required: "Es necesario"
            },
            direccion:{
                required: "Es necesario"
            },
            num_cellphone:{
                required: "Es necesario"
            },
            num_phone:{
                required: "Es necesario"
            },
            poll:{
                required: "Es necesario"
            },
            proteccion_datos:{
                required: "Es necesario que los términos y condiciones."
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

            //console.log("Hola mundo");

        }
    });

    $("#cod_modalidad").change(function() {

        if($(this).val() == 6){

            $('#id_academic_period_label').html(" Fecha de inicio ");
            $('#id_academic_period_txt').attr("style", "display:block");
            $('#id_academic_period').attr("style", "display:none");

            $('#id_academic_period option[value=9]').attr('selected','selected');

            //formValidate(false);

        }  else {

            $('#id_academic_period_label').html(" Peri&oacute;do Acad&eacute;mico ");
            $('#id_academic_period_txt').attr("style", "display:none");
            $('#id_academic_period').attr("style", "display:block");

            //formValidate(true);

        }


    });

    function formValidate(required){

        $("#store").unbind().removeData();
        $("label.error").remove();
        $("input.error").removeClass("error");

        $("#store").validate({
            ignore: [],
            errorPlacement: function(error, element) {

                if(element.attr( "id" ) == 'proteccion_datos'){

                    $(".error_checkbox").show();
                    //console.log("dddd");
                    $(" .error").attr("style", "display:block !important");

                } else {

                    error.insertAfter(element);
                    $(" .chkContent label").attr("style", "display:block !important");
                }
            },
            rules: {

                id_academic_period:{
                    required: required
                },
                cod_modalidad:{
                    required: true
                },
                cod_esp_tipo:{
                    required: true
                },
                cod_esp:{
                    required: true
                },
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
                    required: true,
                    number:true
                },
                correo:{
                    required: true,
                    email: true
                },
                cod_pais: {
                    required: true
                },
                cod_dpto: {
                    required: true
                },
                cod_prov: {
                    required: true
                },
                cod_dist: {
                    required: true
                },
                direccion:{
                    required: true
                },
                num_cellphone:{
                    required: true
                },
                num_phone:{
                    required: true
                },
                poll:{
                    required: true
                },
                proteccion_datos:{
                    required: true
                }

            },
            messages: {
                id_academic_period:{
                    required: "Es necesario"
                },
                cod_modalidad:{
                    required: "Es necesario"
                },
                cod_esp_tipo:{
                    required: "Es necesario"
                },
                cod_esp:{
                    required: "Es necesario"
                },
                nombre:{
                    required: "Es necesario"
                },
                ape_pat:{
                    required: "Es necesario"
                },
                ape_mat:{
                    required: "Es necesario"
                },
                cod_doc_tip:{
                    required: "Es necesario"
                },
                num_doc:{
                    required: "Es necesario",
                    number:"Es necesario"
                },
                correo:{
                    required: "Es necesario",
                    email: "Es necesario que sea un correo electrónico"
                },
                cod_pais: {
                    required: "Es necesario"
                },
                cod_dpto: {
                    required: "Es necesario"
                },
                cod_prov: {
                    required: "Es necesario"
                },
                cod_dist: {
                    required: "Es necesario"
                },
                direccion:{
                    required: "Es necesario"
                },
                num_cellphone:{
                    required: "Es necesario"
                },
                num_phone:{
                    required: "Es necesario"
                },
                poll:{
                    required: "Es necesario"
                },
                proteccion_datos:{
                    required: "Es necesario que los términos y condiciones."
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

                //console.log("Hola mundo");

            }
        });

    }
});