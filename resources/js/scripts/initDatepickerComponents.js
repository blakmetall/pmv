export function initDatepickerComponents() {
    $('.app-input-datepicker').each(function() {
        var dateFormat = $(this).data('format');
        var maxDaysLimitFromNow = $(this).data('max-days-limit-from-now')

        var maxSelectionDate = new Date;
        maxSelectionDate.setDate(maxSelectionDate.getDate() + parseInt(maxDaysLimitFromNow));

        $(this).pickadate({
            selectYears: true,
            selectYears: 70,
            selectMonths: true,
            format: dateFormat,
            formatSubmit: dateFormat,
            max: maxSelectionDate,
        });
    });
}
