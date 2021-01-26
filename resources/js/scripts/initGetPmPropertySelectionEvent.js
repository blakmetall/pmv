import { initDatepickerComponents } from "./initDatepickerComponents.js";

export function initGetPmPropertySelectionEvent(id, container, dataUrl) {
    let selectionModal = $(id);
    let selectionContainer = $(container);
    let url = selectionContainer.data('url');

    selectionModal.on('show.bs.modal', function (e) {
        $.get(url, function(html) {
             selectionContainer
             .html(html)
             .promise()
             .done(function() {
                initDatepickerComponents();
                $("#form-check-availability").on('submit', function(e){
                    e.preventDefault();
                    let action = $(this).attr("action");
                    let req = $(this).serializeArray();
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        type: "POST",
                        url: action,
                        dataType: "json",
                        data: req
                    }).done(function(data) {
                        let dataHtml = `
                            <div>${data.name}</div>
                            <div>${data.type}</div>
                            <div>${data.address}</div>
                            <a href="#" data-toggle="modal" data-source="${data.id}" data-year=""
                                data-target="#modal-availability-${data.id}" class="btn-calendar">
                                Availability Calendar
                            </a> and edit your search.
                        ` ;
                        if(data.afirmation == 'all'){
                            $('.all-dates').hide();
                            $('.some-dates').hide();
                            $('#details-property').show();
                            $('#details-property').html(dataHtml);
                        }else if(data.afirmation == 'some'){
                            $('.all-dates').hide();
                            $('.some-dates span').html(`${data.arrival} - ${data.departure}`);
                            $('.some-dates').show();
                        }else{
                            $('.some-dates').hide();
                            $('.all-dates span').html(`${data.arrival} - ${data.departure}`);
                            $('.all-dates').show();
                        }
                    });
                })
             });
        });
    });


    // $(document).on('change', container, function() {
    //     let select = $(".app-pm-property-select-wrapper select");
    //     let generationUrl = $(".app-pm-property-select-wrapper").data(dataUrl);
    //     let propertyID = select.val();
    //     if(propertyID) {
    //         let propertyUrl = generationUrl + '/' + propertyID;
    //         // document.location = generationUrl + '/' + propertyID;
    //     }
    // });
}
