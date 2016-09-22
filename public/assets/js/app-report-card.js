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
