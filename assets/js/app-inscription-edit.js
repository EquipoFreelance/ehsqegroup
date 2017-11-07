// Init JS Plugin Material Date Picker
$(function(){
    if($('#condicional_date_1').length){
        $('#condicional_date_1').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
    if($('#condicional_date_2').length){
        $('#condicional_date_2').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY', lang : 'es'});
    }
});
