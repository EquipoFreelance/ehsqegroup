$(function(){
    listAuxiliares();
});


function listAuxiliares(){
    $.ajax({
        url:'/api/auxiliares',
        type:'get',
        datatype: 'json',
        data:{"q":"all"},
        beforeSend: function(){
            $(".items").html("Loading...");
        },
        success:function(response)
        {
            console.log(response);
            if(!response){
                var source   = '<tr><td colspan="2" align="center">No existen inscripciones asociadas al Usuario</td></tr>';
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