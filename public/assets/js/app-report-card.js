
/* -- Customs Functions --*/

// Selector de Grupos - Profesores
function wsSelectGroupTeacher(route, element, placeholder)
{
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
            $.each(items, function (i, item) {
                $(element).append($('<option>', {
                    value: item.group.id,
                    text : item.group.nom_grupo
                }));
            });

            $(element).removeAttr("disabled");

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });

}

// Selector de Grupos - Modulos
function wsSelectGroupModules(route, element, placeholder)
{
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
            console.log(items);
            $.each(items, function (i, item) {
                $(element).append($('<option>', {
                    value: item.modulo.id,
                    text : item.modulo.nombre
                }));
            });

            $(element).removeAttr("disabled");

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });

    return false;
}

// Listado de Reporte de notas
function listReportCard(id_group, id_module) {

    if(id_group != '' && id_module != ''){

        $.ajax({
            url:'/api/report-card/group-enrollment/'+id_group+'/'+id_module,
            type:'get',
            datatype: 'json',
            data:{},
            beforeSend: function(){
                $(".report_card_header").empty().append(custom_handlerbars('<tr><td><center>{{ message }}</center></td></tr>', {message: "Loading..."}));
                $(".report_card_body").empty().append(custom_handlerbars('<tr><td><center>{{ message }}</center></td></tr>', {message: "Loading..."}));
            },
            success:function(items)
            {
                console.log(items);

                if(items.response){

                    var response = items.response;



                    // Head
                    $(".report_card_header").empty().append(custom_handlerbars($("#response-template-head").html(), response));

                    // Body
                    if(response.body){
                        $(".report_card_body").empty().append(custom_handlerbars($("#response-template").html(), response));
                    } else {
                        $(".report_card_body").empty().append(custom_handlerbars('<tr><td colspan="'+response.header.length+'"><center>{{ message }}</center></td></tr>', {message: "Sin alumnos matriculados"}));
                    }

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(  response.status == 400){

                    $(".report_card_body").empty().append(custom_handlerbars('<tr><td colspan="2"><center>{{ message }}</center></td></tr>', response.responseJSON));

                }
            }
        });

    } else {
        $(".report_card_header").empty().append(custom_handlerbars('<tr><td><center>{{ message }}</center></td></tr>', {message: "Empty"}));
        $(".report_card_body").empty().append(custom_handlerbars('<tr><td><center>{{ message }}</center></td></tr>', {message: "Empty"}));
    }


    return false;

}

function custom_handlerbars(source, data){
    var source   = source;
    var template = Handlebars.compile(source);
    var html     = template(data);
    return html;
}