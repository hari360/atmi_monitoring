$(function () {
    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm:00',
        clearButton: true,
        weekStart: 1,
        triggerEvent: 'dblclick',
        // time:false
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    // $('.datepicker').bootstrapMaterialDatePicker({
    //     format: 'dddd DD MMMM YYYY',
    //     clearButton: true,
    //     weekStart: 1,
    //     time: false
    // });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });
});