// Functions Javascript for App

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

// Si lo valores por defecto son diferentes a Vacío
if(group_cod_mod != '' && group_cod_esp_tipo != ''){

    // Realizar change
    $(".group_cod_esp_tipo").trigger("change");



}


/*
  @route string
*/
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
  response_html = $(element).append($('<option>', {
    value: 0,
    text : str
  }));
  return response_html;
}
