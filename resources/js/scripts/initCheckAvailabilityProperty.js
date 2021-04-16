import { initDatepickerComponents } from "./initDatepickerComponents.js";

export function initCheckAvailabilityProperty() {
    let selectionModal = $("#app-property-bookings-selection-modal");
    let selectionContainer = $("#app-property-bookings-selection-container");
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
                        $("#modal-availability-modal .btns-container a").attr('data-source', data.id);
                        $("#modal-availability-modal .modal-title").html(data.name);
                        let datesAvailability = [];
                        datesAvailability.push(data.arrival);
                        datesAvailability.push(data.departure);
                        localStorage.setItem('dates-availability', JSON.stringify(datesAvailability));
                        let dataHtml = `
                        <div class="table-responsive" style="margin-top: 20px">
                            <table class="table table-striped">
                                <tr>
                                    <th scope="col">Property</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Bedrooms</th>
                                    <th scope="col">Baths</th>
                                    <th scope="col">Max Occ.</th>
                                </tr>
                                <tr>
                                    <td>
                                        ${data.name}
                                    </td>

                                    <td>
                                        ${data.address}
                                    </td>

                                    <td>
                                        ${data.type}
                                    </td>

                                    <td>
                                        ${data.beds}
                                    </td>

                                    <td>
                                        ${data.baths}
                                    </td>

                                    <td>
                                        ${data.pax}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Cleaning Frecuency</th>
                                    <th scope="col">Nights</th>
                                    <th scope="col">Min Stay</th>
                                    <th scope="col">Nightly Rate</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                                <tr>
                                    <td>
                                        ${data.cleaning}
                                    </td>

                                    <td>
                                        ${data.nights}
                                    </td>
                                    
                                    <td>
                                        ${data.minStay}
                                    </td>

                                    <td>
                                        ${data.nightlyRate}
                                    </td>

                                    <td>
                                        ${data.total}
                                    </td>

                                    <td>
                                    
                                    </td>
                                </tr>
                            </table>
                            <a href="${data.route}" class="btn btn-primary m-1">
                                Book Property
                            </a>
                            <a href="#" data-toggle="modal" data-source="${data.id}" data-year="${data.year}"
                                data-target="#modal-availability-modal" class="btn-calendar btn btn-primary m-1">
                                Availability Calendar
                            </a>
                        </div>
                        ` ;
                        if(data.afirmation == 'all'){
                            $('.all-dates').hide();
                            $('.some-dates').hide();
                            $('#details-property').show();
                            $('#details-property').html(dataHtml);
                        }else if(data.afirmation == 'some'){
                            $('.all-dates').hide();
                            $('#details-property').hide();
                            $('#details-property').html('');
                            $('.some-dates span').html(`${data.arrival} - ${data.departure} 
                                - <a href="#" data-toggle="modal" data-source="${data.id}" data-year="${data.year}"
                                data-target="#modal-availability-modal" class="btn-calendar">
                                Availability Calendar
                            </a>`);
                            $('.some-dates').show();
                        }else{
                            $('.some-dates').hide();
                            $('#details-property').hide();
                            $('#details-property').html('');
                            $('.all-dates span').html(`${data.arrival} - ${data.departure}
                                - <a href="#" data-toggle="modal" data-source="${data.id}" data-year="${data.year}"
                                data-target="#modal-availability-modal" class="btn-calendar">
                                Availability Calendar
                            </a>`);
                            $('.all-dates').show();
                        }
                    });
                })
             });
        });
    });
}
