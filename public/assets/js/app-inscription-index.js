
$(function(){
    listInscriptions(0);
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
        var source   = $("#response-template").html();
        var template = Handlebars.compile(source);
        var html    = template(response);
        $(".items").html(html);
        console.log(response);
     },
     error:function(response)
    {
      if(  response.status == 204){

      }
    }
  });
}
