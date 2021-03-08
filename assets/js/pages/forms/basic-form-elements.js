$(function () {
    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm:00',
        clearButton: true,
        weekStart: 1,
        triggerEvent: 'dblclick',
        // time:false
    });

    $('.date').bootstrapMaterialDatePicker({ 
        weekStart : 0,
        clearButton: true,
        triggerEvent: 'dblclick',
        time: false 
    
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });
});