
/* -- Customs Functions --*/

// Selector de Grupos - Profesores
function wsSelectGroupAll(route, element, placeholder)
{
    $.ajax({
        url:route,
        type:'get',
        datatype: 'json',
        data:{"q":"ALL"},
        beforeSend: function(){

            DefaultOptionSelect(element, placeholder);
        },
        success:function(items)
        {
            $.each(items.response, function (i, item) {
                $(element).append($('<option>', {
                    value: item.id,
                    text : item.nom_grupo
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
function wsSelectGroupTeacherModules(route, element, placeholder, id_group)
{
    $.ajax({
        url:route,
        type:'get',
        datatype: 'json',
        data:{"id_group" : id_group },
        beforeSend: function(){

            DefaultOptionSelect(element, placeholder);
        },
        success:function(items)
        {
            console.log(items);
            $.each(items, function (i, item) {
                $(element).append($('<option>', {
                    value: item.module.id+"-"+item.teacher.id,
                    text : item.module.nombre+" / "+item.teacher.ape_mat+ " " +item.teacher.ape_pat+ " " +item.teacher.nombre
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
function listReportCard(id_group) {

    if(id_group != ''){

        $.ajax({
            url:'/api/groups/group-enrollment/',
            type:'get',
            datatype: 'json',
            data:{"cod_grupo":id_group},
            beforeSend: function(){
                $(".save").attr("disabled", "disabled");
                $(".title_type_nota").html($("#cod_mod option:selected").text());
                $(".report_card_body").empty().append(custom_handlerbars('<tr><td colspan="3"><center>{{ message }}</center></td></tr>', {message: "Loading..."}));
            },
            success:function(response)
            {
                console.log(response);

                if(response){

                    if(response){

                        $(".report_card_header").show();
                        $(".save").removeAttr("disabled");
                        $(".report_card_body").empty().append(custom_handlerbars($("#response-template").html(), response));

                    } else {
                        $(".report_card_body").empty().append(custom_handlerbars('<tr><td colspan="3"><center>{{ message }}</center></td></tr>', {message: "Sin alumnos matriculados"}));
                    }

                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(  response.status == 400){

                    $(".report_card_body").empty().append(custom_handlerbars('<tr><td colspan="3"><center>{{ message }}</center></td></tr>', response.responseJSON));

                }
            }
        });

    } else {
        $(".report_card_body").empty().append(custom_handlerbars('<tr><td class="3"><center>{{ message }}</center></td></tr>', {message: "Empty"}));
    }


    return false;

}

function custom_handlerbars(source, data){
    var source   = source;
    var template = Handlebars.compile(source);
    var html     = template(data);
    return html;
}