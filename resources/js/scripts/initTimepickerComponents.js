export function initTimePickerComponents(className) {
    $('.app-input-timepicker').each(function() {
        var input = $(this);

        var timeFormat = input.data('time-format');
        var timeInterval = input.data('time-interval');

        input.timepicker({
            timeFormat: timeFormat,
            interval: timeInterval,
            minTime: '00:00',
            maxTime: '23:59',
            startTime: '00:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        }); 

    });
}
