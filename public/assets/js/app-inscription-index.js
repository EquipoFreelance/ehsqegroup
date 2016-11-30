
$(function(){
    listInscriptions($("#created_by").val());
});


/* -- Customs Functions --*/

// Inscription Lists
function listInscriptions(created_by){
  $.ajax({
     url:'/api/inscriptions',
     type:'get',
     datatype: 'json',
     data:{"created_by":created_by},
     beforeSend: function(){
         $(".items").html("Loading...");
     },
     success:function(response)
     {
        console.log(response);
        if(!response){
            var source   = '<tr><td colspan="9" align="center">No existen inscripciones asociadas al Usuario</td></tr>';
            var template = Handlebars.compile(source);
            var html    = template(response);
            $(".items").html(html);
        }else{
            var source   = $("#response-template").html();
            var template = Handlebars.compile(source);
            var html    = template(response);
            $(".items").html(html);
        }


        //console.log(response);
     },
     error:function(response)
    {
      console.log(response);
      if(  response.status == 404){
        console.log("dddd");
      }
    }
  });
}
