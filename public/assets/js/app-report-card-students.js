// Listado de Reporte de notas
function listEspecializationStudents(id_student) {

    $.ajax({
        url:'/api/enrollments/especialization-by-enrollment',
        type:'get',
        datatype: 'json',
        data:{"id_student":id_student},
        beforeSend: function(){


        },
        success:function(items)
        {

            $.each(items.data, function (i, item) {
                $("#especializacion_ca").append($('<option>', {
                    value: item.esp_id,
                    text : item.esp_name,
                    data_id_enrollment : item.id_enrollment
            }));
            });


        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });

}

function listReportCard(id_esp, id_enrollment){
    $.ajax({
        url:'/api/enrollments/modules-by-especialization',
        type:'get',
        datatype: 'json',
        data:{"id_esp":id_esp, "id_enrollment":id_enrollment},
        beforeSend: function(){


        },
        success:function(items)
        {

            var source   = $("#response-template").html();
            var template = Handlebars.compile(source);
            var html    = template(items);

            $(".add_notes").html(html).hide().fadeIn();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });
}

$(function(){
    listEspecializationStudents($("#id_student").val());

    $( "#especializacion_ca" ).change(function() {

        var element = $(this).find('option:selected');
        var id_enrollment = element.attr("data_id_enrollment");

        //console.log(id_enrollment);
        listReportCard($(this).val(), id_enrollment);
    });
})