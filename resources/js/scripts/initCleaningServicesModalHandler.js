import { initDatepickerComponents } from "./initDatepickerComponents.js";

export function initCleaningServicesModalHandler() {
    var modals = $(".app-cleaning-service-modal");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-cleaning-service-modal-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            let propertyID = $(e.relatedTarget).data("property");
            let propertyDate = $(e.relatedTarget).data("date");
            $.get(url, function(html) {
                container
                    .html(html)
                    .promise()
                    .done(function() {
                        modal.modal("handleUpdate");
                        initDatepickerComponents();
                        setTimeout(function() {
                            $("#field_cleaning-service_property_id_").val(
                                propertyID
                            );
                            $("#field_cleaning-service_date_").val(
                                propertyDate
                            );
                        }, 500);
                    });
            });
        });
    });
}
