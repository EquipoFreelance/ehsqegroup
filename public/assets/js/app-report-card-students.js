
// Listado de Reporte de notas
function listEspecializationStudents() {

    $.ajax({
        url:'http://api.hsqegroup.app/api/enrollments/especialization-by-enrollment',
        type:'get',
        datatype: 'json',
        data:{"id_student":"257"},
        beforeSend: function(){


        },
        success:function(items)
        {

            $.each(items.data, function (i, item) {
                $("#especializacion_ca").append($('<option>', {
                    value: item.esp_id,
                    text : item.esp_name
                }));
            });


        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
        }
    });

}
$(function(){
    listEspecializationStudents();
})