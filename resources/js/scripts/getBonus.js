export function getBonus(value, date) {
    let url = $("#field_property_sunday_bonus_").data("route");
    if (value) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "GET",
            url: url,
            dataType: "json",
            data: { id: value }
        }).done(function(data) {
            if (date == 6) {
                $("#field_property_sunday_bonus_").val(data);
            } else {
                $("#field_property_sunday_bonus_").val("0.00");
            }
        });
    } else {
        $("#field_property_sunday_bonus_").val("0.00");
    }
}
