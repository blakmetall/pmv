
jQuery(function($){

$.datepicker.regionales = {
    clearText: 'Limpiar', 
    clearStatus: 'Clear',
    closeText: 'Cerrar', 
    closeStatus: 'Cerrar sin Modificar', 
    prevText: '<Prev', 
    prevStatus: 'Mostrar Mes Previo', 
    nextText: 'Sig.>', 
    nextStatus: 'Mostrar Mes Siguiente', 
    currentText: 'Mes', 
    currentStatus: 'Mostrar el Mes de hoy', 
    monthNames: ['Enero','Febrero','Marzo','Abril','May','Jun', 'Julio','Ago','Septiembre','Octubre','Noviembre','Diciembre'], 
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun', 'Jul','Ago','Sep','Oct','Nov','Dic'], 
    monthStatus: 'Mostrar Mes Distinto', 
    yearStatus: 'Mostrar Año Distinto', 
    weekHeader: 'Sm', 
    weekStatus: 'Semana del Año', 
    dayNames: ['Domingo','Lunes','Mates','Miercoles','Jueves','Viernes','Sábado'], 
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'], 
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'], 
    dayStatus: 'Seleccione Día Mes Año', 
    dateStatus: 'Seleccione DD, MM d', 
    dateFormat: 'dd/mm/aa', 
    firstDay: 0, 
    initStatus: 'Seleccione una Fecha', 
    isRTL: false
};

$.datepicker.setDefaults($.datepicker.regionales);

});