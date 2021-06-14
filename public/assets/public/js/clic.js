var viewport = get_viewport();
jQuery(window).resize(function(){
    viewport = get_viewport();
});

function get_viewport(){
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
    return {w: w, h: h};
}

function prepare_home_search() {
    var tr1 = jQuery("#avail-search-form table tr:eq(0)");
    var tr2 = jQuery("#avail-search-form table tr:eq(1)");

    // replace inputs
    tr1.find('td:eq(0)').append(tr2.find('td:eq(0) > div').clone());
    tr1.find('td:eq(1)').append(tr2.find('td:eq(1) > div').clone());
    tr1.find('td:eq(2)').append(tr2.find('td:eq(2) > div').clone());
    tr1.find('td:eq(3)').append(tr2.find('td:eq(3) > div').clone());

    // remove old values
    tr2.find('td:eq(3)').remove();
    tr2.find('td:eq(2)').remove();
    tr2.find('td:eq(1)').remove();
    tr2.find('td:eq(0)').remove();

    // re-initialize datepicker
    var cloned_datepicker = tr1.find('td:eq(2) > div:eq(1)');
    var input = cloned_datepicker.find('input');
    input.removeClass('hasDatepicker');

    input.datepicker({
        dateFormat: 'D dd/M/yy',
        altFormat: 'yy-mm-dd',
        altField: '#departure-alt',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        minDate: '+2d',
        onClose: function( selectedDate ) {
            jQuery('#edit-arrival').datepicker('option', 'maxDate', selectedDate );
        }
    });
}

// handlers
setTimeout(function(){
    prepare_home_search();
}, 500);

(function ($) {
    
    $('#edit-arrival').datepicker({
        dateFormat: 'D dd/M/yy',
        altFormat: 'yy-mm-dd',
        altField: '#arrival-alt',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        minDate: '+1d',
        onClose: function( selectedDate ) {
            $('#edit-departure').datepicker('option', 'minDate', selectedDate );
        }
    });

    $("#edit-arrival").trigger("click");
    
    $('#edit-departure').datepicker({
        dateFormat: 'D dd/M/yy',
        altFormat: 'yy-mm-dd',
        altField: '#departure-alt',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        minDate: '+2d',
        onClose: function( selectedDate ) {
            $('#edit-arrival').datepicker('option', 'maxDate', selectedDate );
        }
    });

    $("#edit-departure").trigger("click");

    $('#edit-arrival-sing').datepicker({
        dateFormat: 'D dd/M/yy',
        altFormat: 'yy-mm-dd',
        altField: '#arrival-alt-sing',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        minDate: '+1d',
        onClose: function( selectedDate ) {
            $('#edit-departure-sing').datepicker('option', 'minDate', selectedDate );
        }
    });

    $("#edit-arrival-sing").trigger("click");
    
    $('#edit-departure-sing').datepicker({
        dateFormat: 'D dd/M/yy',
        altFormat: 'yy-mm-dd',
        altField: '#departure-alt-sing',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 2,
        minDate: '+2d',
        onClose: function( selectedDate ) {
            $('#edit-arrival-sing').datepicker('option', 'maxDate', selectedDate );
        }
    });

    $("#edit-departure-sing").trigger("click");

})(jQuery);