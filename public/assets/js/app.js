// Functions Javascript for App

// Routes
var routes = {
  ub_countries    : '/dashboard/json/ub/countries',
  ub_departaments : '/dashboard/json/departaments/',
  ub_provinces    : '/dashboard/json/provinces/',
  ub_districts    : '/dashboard/json/districts/',
  esp_tipo        : '/dashboard/json/esp_tipos',
  especializacion : '/dashboard/json/especializaciones/',
  modalidades     : '/dashboard/json/modalidades',
};

// Create Groups
var group_cod_mod       = $('.group_cod_mod option:selected').val();
var group_cod_esp_tipo  = $('.group_cod_esp_tipo option:selected').val();
var group_cod_esp       = $("#cod_esp").attr("data-id");

$(".group_cod_mod").change(function() {
  group_cod_mod = $(this).val();
});

$(".group_cod_esp_tipo").change(function() {
    group_cod_esp_tipo = $(this).val();
    ListEspecializaciones('/dashboard/json/esp/'+group_cod_mod+'/'+group_cod_esp_tipo);
});

// Ub Países
if($("#cod_pais").length > 0){
   wsUbigeo(routes.ub_countries, "#cod_pais", "-- Seleccione el País --");
}

// Ub Departamentos
$("#cod_pais").change(function(){
  wsUbigeo(routes.ub_departaments+$(this).val(), "#cod_dpto", "-- Seleccione el Departamento --");
});

// Ub Pronvincias
$("#cod_dpto").change(function(){
  wsUbigeo(routes.ub_provinces+$(this).val(), "#cod_prov", "-- Seleccione la provincia --");
});

// Ub Distritos
$("#cod_prov").change(function(){
  wsUbigeo(routes.ub_districts+$("#cod_dpto").val()+"/"+$(this).val(), "#cod_dist", "-- Seleccione el distrito --");
});

if($("#cod_esp_tipo").length > 0){
    // Set List Tipo de Especialización
    wsUbigeo(routes.esp_tipo, "#cod_esp_tipo", "-- Seleccione el tipo de especialización --");
}

if($("#cod_modalidad").length > 0){
    // Set List Modalidades
    wsUbigeo(routes.modalidades, "#cod_modalidad", "-- Seleccione la modalidad --");
}




// Si lo valores por defecto son diferentes a Vacío
if(group_cod_mod != '' && group_cod_esp_tipo != ''){
    // Realizar change
    $(".group_cod_esp_tipo").trigger("change");
}

$("#cod_esp_tipo").change(function(){
    listEspecializations($("#cod_modalidad").val(), $(this).val());
});

/*
  @route string
*/

function listEspecializations(id_mod, id_type_esp){

    $.ajax({
        url:'/api/especialization',
        type:'get',
        datatype: 'json',
        data:{id_mod:id_mod, id_type_esp:id_type_esp},
        beforeSend: function(){
            $("#cod_esp").empty();
            $("#cod_esp").append($('<option>', {
                value: "",
                text : "-- Seleccione la especialización --"
            }));
        },
        success:function(items)
        {
            var attr = $("#cod_esp").attr("data-id-default");

            if(items){

                var items = items.response;

                $.each(items, function (i, item) {

                    $("#cod_esp").append($('<option>', {
                        value: item.id,
                        text : item.nom_esp
                    }));

                    // Su el valor existe
                    if( attr == item.id ){
                        $('#cod_esp').val(attr).attr("value", attr).attr("selected", "selected");
                    }

                });
            }


        },
        error:function(data)
        {


        }
    });
}

function ListEspecializaciones(route){
  $.ajax({
     url:route,
     type:'get',
     datatype: 'json',
     data:{},
     beforeSend: function(){
       $(".group_cod_esp").empty();
       DefaultOptionSelect(".group_cod_esp", "-- Seleccione la Especialización --");
     },
     success:function(items)
     {
       $.each(JSON.parse(items), function (i, item) {

          $(".group_cod_esp").append($('<option>', {
            value: item.id,
            text : item.nom_esp
          }));

          // Su el valor existe
          if( group_cod_esp == item.id ){
            $('#cod_esp').val(group_cod_esp).attr("value", group_cod_esp).attr("selected", "selected");
          }

      });

     },
     error:function(data)
     {


     }
   });
}

function DefaultOptionSelect(element, str){
  $(element).empty();
  $(element).attr("disabled", "disabled");
  response_html = $(element).append($('<option>', {
    value: '',
    text : str
  }));
  return response_html;
}

function wsUbigeo(route, element, placeholder){
  $.ajax({
     url:route,
     type:'get',
     datatype: 'json',
     data:{},
     beforeSend: function(){
       DefaultOptionSelect(element, placeholder);
     },
     success:function(items)
     {
       setListItems(JSON.parse(items), element);
     }
   });
}

function wsSelect(route, element, placeholder){
    $.ajax({
        url:route,
        type:'get',
        datatype: 'json',
        data:{},
        beforeSend: function(){

            DefaultOptionSelect(element, placeholder);
        },
        success:function(items)
        {
            setListItems(items, element);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });
}

function setListItems(data, element){

   var attr = $(element).attr("data-id-default");

   $.each(data, function (i, item) {
     $(element).append($('<option>', {
       value: item.id,
       text : item.name
     }));

     // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
     if (typeof attr !== typeof undefined && attr !== false) {
       if( attr == item.id ){
         $(element).val(attr).attr("value", attr).attr("selected", "selected");
         $(element).change();
       }
     }


   });
   $(element).removeAttr("disabled");
   return false;
}
