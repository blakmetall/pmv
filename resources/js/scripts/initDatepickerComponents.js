import { getBonus } from "./getBonus.js";

export function initDatepickerComponents() {
    $(".app-input-datepicker").each(function() {
        var dateFormat = $(this).data("format");
        var maxDaysLimitFromNow = $(this).data("max-days-limit-from-now");

        var maxSelectionDate = new Date();
        maxSelectionDate.setDate(
            maxSelectionDate.getDate() + parseInt(maxDaysLimitFromNow)
        );

        if(!$(this).attr('readonly')){
            $(this).pickadate({
                selectYears: true,
                selectYears: 70,
                selectMonths: true,
                format: dateFormat,
                formatSubmit: dateFormat,
                max: maxSelectionDate,
                onSet: function(context) {
                    let date = new Date(context.select * 1000).getDay();
                    let propertyID =
                        $("#field_cleaning-service_property_id_").val() || false;
                    // getBonus(propertyID, date);
                }
            });
        }

    });

    // Select min departure date from arrival date
    $("input[name='arrival_date']").on('change', function() {
        var arrival_date = $(this).val();

        $("input[name='departure_date']").each(function(){
            var picker_departure = $(this).pickadate('picker');
            picker_departure.set('select', arrival_date);
        });
    });

    // Select min calculator rate
    $("input[name='from_date']").on('change', function() {
        var from_date = $(this).val();

        $("input[name='to_date']").each(function(){
            var picker_to_date = $(this).pickadate('picker');
            picker_to_date.set('select', from_date);
        });
    });
}
