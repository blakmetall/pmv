export function initGetPmPropertySelectionEvent() {
    let selectionModal = $("#app-pm-property-selection-modal");
    let selectionContainer = $("#app-pm-property-selection-container");
    let url = selectionContainer.data('url');
    selectionModal.on('show.bs.modal', function (e) {
        $.get(url, function(html) {
             selectionContainer
             .html(html)
             .promise()
             .done(function() {
                 $(".app-pm-property-select-wrapper select").on('change', function() {
                     let generationUrl = $(".app-pm-property-select-wrapper").data('generate-pm-transaction-url');
                     let propertyID = $(this).val();
                     if(propertyID) {
                         let propertyUrl = generationUrl + '/' + propertyID;
                         document.location = propertyUrl;
                     }
                 });
             });
        });
    });
}
