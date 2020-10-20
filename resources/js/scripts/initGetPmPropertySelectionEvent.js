export function initGetPmPropertySelectionEvent(id, container, dataUrl) {
    let selectionModal = $(id);
    let selectionContainer = $(container);
    let url = selectionContainer.data('url');

    selectionModal.on('show.bs.modal', function (e) {
        $.get(url, function(html) {
             selectionContainer.html(html);
        });
    });

    $(document).on('change', container, function() {
        let select = $(".app-pm-property-select-wrapper select");
        let generationUrl = $(".app-pm-property-select-wrapper").data(dataUrl);
        let propertyID = select.val();

        if(propertyID) {
            document.location = generationUrl + '/' + propertyID;
        }
    });
}
