// Periódo Académico
if( $("#id_academic_period").length > 0){
    wsUbigeo('/hsqegroup/api/academic-period', "#id_academic_period", "-- Seleccione el periódo académico --");
}
// Init JS Plugin Material Date Picker
$(function(){
    if($('#start_date').length){
        $('#start_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
    if($('#finish_date').length){
        $('#finish_date').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
});

