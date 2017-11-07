/**
 * Created by JUAN on 05/06/2017.
 */

function showActa(id_group, cod_esp){
    $.ajax({
        url:"/api/actas",
        type:'get',
        datatype: 'json',
        data:{id_group:id_group, cod_esp:cod_esp},
        beforeSend: function(){

        },
        success:function(rs)
        {

            var response = rs.response.header;

            if(response.especialization){
                $(".title_esp").html(response.especialization);
            }

            if(response.place){
                $(".title_place").html(response.place);
            }

            if(response.schedule){
                $(".title_schedule").html(response.schedule);
            }

            if(response.duration){
                $(".title_duration").html(response.duration);
            }

            if(response.observation){
                $(".title_observation").html(response.observation);
            }

            if(rs.response.body.header.group_count_esp){

                // Grupo de especializaciones
                var group_count_esp = rs.response.body.header.group_count_esp;

                $.each(group_count_esp, function(i, item) {
                    $(".gp_"+i).html(item);
                });

            }

            if(rs.response.body.modules){

                // Grupo de especializaciones
                var modules = rs.response.body.modules;

                $.each(modules, function(i, item) {
                    $(".mod_"+i).html(item.name);
                    $(".t_"+i).html(item.teacher);
                });

            }

            if(rs.response.body){

                var data     = rs.response.body;
                var source   = $("#response-template").html();
                var template = Handlebars.compile(source);
                var html     = template(data);

                $( ".space" ).after( html );
            }


        }
    });
}