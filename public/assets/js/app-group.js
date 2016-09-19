/**
 * Created by JUAN on 18/09/2016.
 */
// Init JS Plugin Material Date Picker
$(function(){
    if($('#fe_inicio').length){
        $('#fe_inicio').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
    if($('#fe_fin').length){
        $('#fe_fin').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
});