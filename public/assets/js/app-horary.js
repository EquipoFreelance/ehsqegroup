/**
 * Created by JUAN on 30/08/2016.
 */

// JS - Horario Index

// Lista los horarios por la seleccion Grupo
if( $("#id_group").length > 0 ){
    wsSelect('/hsqegroup/api/groups', "#id_group", " -- Seleccione el Grupo -- ");
    listHorary('-');
}

$("#id_group").change(function(){
    listHorary($(this).val());
});


// JS - Horario Docentes - Index

// Lista los horarios disponibles
if( $(".id_academic_period_list").length > 0 ){
    $(".id_academic_period_list").change(function(){
        listHoraryByTeaher($(this).val(), $(this).attr("attr-id-docente"));
    });
    listHoraryByTeaher(0, $(".id_academic_period_list").attr("attr-id-docente") );
}



// JS - Form Create and Form Update

// Init JS Plugin TimePicker
if( $('#h_inicio').length > 0 ){

    $('#h_inicio').timepicker({
        defaultTime: false
    });

}

if( $('#h_fin').length > 0 ){

    $('#h_fin').timepicker({
        defaultTime: false
    });

}

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

/*
 * Listado de Horarios Por Periodo Academico y Por Id de Docente
 * */
function listHoraryByTeaher(id_academic_period, cod_docente){

    var source   = '<tr><td colspan="5"><center>{{ message }}</center><td></tr>';
    var template = Handlebars.compile(source);
    var html     = template({message: "Loading..."});

    $.ajax({
        url:'/hsqegroup/api/teacher/academic-horary/'+id_academic_period+'/'+cod_docente,
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){
            $(".items").empty().append(html);
        },
        success:function(rs)
        {

            if(rs.response != ''){

                var source   = $("#response-template").html();
                var template = Handlebars.compile(source);
                var html     = template(rs);
                $(".items").empty().append(html);

            } else {

                $(".items").empty().append('<tr><td colspan="5"><center>Empty</center><td></tr>');

            }

        },
        error:function(response)
        {
            if(  response.status == 400){
                var source   = '<tr><td colspan="5"><center>{{ message }}</center><td></tr>';
                var template = Handlebars.compile(source);
                var html    = template(response.responseJSON);
                $(".items").empty().append(html);
            }
        }
    }).done(function(data){


    });
}