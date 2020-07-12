export function initGetPmPropertySelectionEvent() {
    var selectionModal = $("#app-pm-property-selection-modal");
    var selectionContainer = $("#app-pm-property-selection-container");
    var url = selectionContainer.data('url');

    selectionModal.on('show.bs.modal', function (e) {
        $.get(url, function(html) {
             selectionContainer.html(html);
        });
    });

    $(document).on('change', "#app-pm-property-selection-container", function() {
        var select = $(".app-pm-property-select-wrapper select");
        var generationUrl = $(".app-pm-property-select-wrapper").data('generate-pm-transaction-url');
        var propertyID = select.val();

        if(propertyID) {
            document.location = generationUrl + '/' + propertyID;
        }
    });
}
