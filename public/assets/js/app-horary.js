/**
 * Created by JUAN on 30/08/2016.
 */

// JS - Index

if( $("#id_group").length > 0 ){
    wsSelect('/hsqegroup/api/groups', "#id_group", " -- Seleccione el Grupo -- ");
    listHorary('-');
}


$("#id_group").change(function(){
    listHorary($(this).val());
});

// JS - Form Create and Form Update

// Init JS Plugin TimePicker
$('#h_inicio, #h_fin').timepicker({
    defaultTime: false
});

// Init JS Plugin Material Date Picker
$(function(){
    if($('#fec_inicio').length){
        $('#fec_inicio').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
    if($('#fec_fin').length){
        $('#fec_fin').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
});

// Init JS Selects

// Groups
if( $("#cod_grupo").length > 0 ) {

    // Load Data
    wsSelect('/hsqegroup/api/groups', "#cod_grupo", " -- Seleccione el Grupo -- ");

    $("#cod_mod").attr("disabled", true);

    // Event Change
    $("#cod_grupo").change(function(){
        wsSelect('/api/horary-modules/' + $(this).val(), "#cod_mod", " -- Seleccione el Módulo -- ");
    });

}

// Profesors
( $("#cod_docente").length > 0 )?

// Load Data
wsSelect('/api/horary-teachers/all', "#cod_docente", " -- Seleccione el Docente -- ") : true ;


// Auxiliar
($("#cod_auxiliar").length > 0 )?
// Load Data
wsSelect('/api/horary-auxiliary/all', "#cod_auxiliar", " -- Seleccione el Auxiliar -- ") : true ;


// Init JS Plugin Select2
/*var data_set = [];
var cod_grupo     = '';
var cod_modalidad       = '';
var cod_esp_tipo  = '';
var cod_esp       = '';
var url = '';*/


//$("#cod_mod").prop("disabled", true);


/*
* Genera un Elemento Select2 con datos remotos
* element            : Nombre del Elemento Html
* asinc              : Función con los parametros necesario para cargar elementos
* placeholder        : Mostrar el valor por defecto
* minimumInputLength : Definiendo si el buscador tendrá un minimo de palabras en su busqueda
* */
function select2Generate(element, asinc, placeholder, minimumInputLength, params){

    if($(element).length){
        return $(element).select2({
            minimumInputLength: minimumInputLength,
            theme: "classic",
            placeholder: placeholder,
            ajax: asinc(params),
            allowClear: true,
            templateResult : function (repo) {
                return repo.text;
            },
            formatNoMatches: function(term) {
                return "B&uacute;squeda sin resultados";
            }
        });
    } else {
        return false;
    }

}

/*
* Genera un Elemento select2 por defecto
* element            : Nombre del Elemento Html
* placeholder        : Mostrar el valor por defecto
* */
function select2Default(element, placeholder){
    return $(element).select2({
        theme: "classic",
        placeholder: placeholder
    });
}

/*
* Función Definida para cargar modulos
* */
function ajax_modulo(p){
    //console.log(params);
    data_set = [];
    return {
        url: function (params) {

            if (typeof(params.term) == "undefined"){
                return '/dashboard/json/modulos/' + p.cod_modalidad + "/" + p.cod_esp_tipo + "/" + p.cod_esp+ "/-";
            } else {
                return '/dashboard/json/modulos/' + p.cod_modalidad + "/" + p.cod_esp_tipo + "/" + p.cod_esp + "/" + p.term;
            }

        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            data_set = [];
            $.each(data.items, function(i, item) {
                data_set.push(
                    {
                        id : item.id,
                        text : item.name
                    }
                );
            });
            return {
                results: data_set
            };
        },
        cache: true
    }

}

/*
 * Función Definida para cargar Grupos
 * */
function ajax_grupo(){
    /*return {
        url: function (params) {
            return '/hsqegroup/api/groups/search/' + params.term;
        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            data_set = [];
            $.each(data.items, function(i, item) {
                data_set.push(
                    {
                        id : item.id,
                        text : item.name,
                        cod_sede : item.cod_sede,
                        nom_sede : item.sede.nom_local,
                        cod_modalidad : item.cod_modalidad,
                        nom_mod : item.modalidad.nom_mod,
                        cod_esp_tipo : item.cod_esp_tipo,
                        nom_esp_tipo : item.tipo_especializacion.nom_esp_tipo,
                        cod_esp : item.cod_esp,
                        nom_esp : item.especializacion.nom_esp,
                    }
                );
            });
            return {
                results: data_set
            };
        },
        cache: true
    }*/
}

/*
 * Función Definida para cargar Docentes
 * */
function ajax_teachers(){
    data_set = [];
    return {
        url: function (params) {

            if (typeof(params.term) == "undefined"){
                return '/hsqegroup/api/teachers/search/-';
            } else {
                return '/hsqegroup/api/teachers/search/' + params.term;
            }

        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            data_set = [];
            $.each(data.items, function(i, item) {
                data_set.push(
                    {
                        id : item.id,
                        text : item.persona.nombre
                    }
                );
            });
            return {
                results: data_set
            };
        },
        cache: true
    }

}

/*
 * Función Definida para cargar Auxiliares
 * */
function ajax_auxiliary(){
    data_set = [];
    return {
        url: function (params) {

            if (typeof(params.term) == "undefined"){
                return '/hsqegroup/api/auxiliary/search/-';
            } else {
                return '/hsqegroup/api/auxiliary/search/' + params.term;
            }

        },
        dataType: 'json',
        delay: 250,
        processResults: function (data, params) {
            data_set = [];
            if(data.items){
                $.each(data.items, function(i, item) {
                    data_set.push(
                        {
                            id : item.id,
                            text : item.persona.nombre
                        }
                    );
                });
                return {
                    results: data_set
                };
            }

        },
        cache: true
    }

}

/*
 * Listado de Horarios
 * */
function listHorary(id){

    var source   = '<tr><td colspan="7"><center>{{ message }}</center><td></tr>';
    var template = Handlebars.compile(source);
    var html     = template({message: "Loading..."});

    $.ajax({
        url:'/hsqegroup/api/academic-horary/'+id,
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
                var source   = '<tr><td colspan="7"><center>{{ message }}</center><td></tr>';
                var template = Handlebars.compile(source);
                var html    = template(response.responseJSON);
                $(".items").empty().append(html);
            }
        }
    }).done(function(data){


    });
}