import { initConfirmClick } from "./scripts/initConfirmClick.js";
import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { initCalendar } from "./scripts/initCalendar.js";
import { getBonus } from "./scripts/getBonus.js";
import { initDatepickerComponents } from "./scripts/initDatepickerComponents.js";
import { initFastSelectComponents } from "./scripts/initFastSelectComponents.js";
import { initGetPmPropertySelectionEvent } from "./scripts/initGetPmPropertySelectionEvent.js";
import { initCheckAvailabilityProperty } from "./scripts/initCheckAvailabilityProperty.js";
import { initTransactionCheckboxHandler } from "./scripts/initTransactionCheckboxHandler.js";
import { initMapInputComponents } from "./scripts/initMapInputComponents.js";
import { initTimepickerComponents } from "./scripts/initTimepickerComponents.js";
import { initTransactionModalHandler } from "./scripts/initTransactionModalHandler.js";
import { initContactModalHandler } from "./scripts/initContactModalHandler.js";
import { initCleaningServicesModalHandler } from "./scripts/initCleaningServicesModalHandler.js";
import { initNotificationsModalHandler } from "./scripts/initNotificationsModalHandler.js";
import { initDeleteImageModalHandler } from "./scripts/initDeleteImageModalHandler.js";
import { initCalendarModalHandler } from "./scripts/initCalendarModalHandler.js";
import { initTooltip } from "./scripts/initTooltip.js";
import { initDeleteSelectableCheckbox } from "./scripts/deleteSelectableCheckbox.js";
import { reservationTransactionCalculator } from "./scripts/reservationTransactionCalculator.js";
import { orderingImages } from "./scripts/orderingImages.js";

$(function() {
    /////////////////////////////
    /////////////////////////////

    var viewport = {
        x: 0,
        y: 0
    };

    /////////////////////////////
    /////////////////////////////

    $(window).resize(resize);

    function init() {
        handleMenuFit();
        initConfirmClick();
        initCalendar();
        initDatepickerComponents();
        initFastSelectComponents();
        initGetPmPropertySelectionEvent();
        initCheckAvailabilityProperty();
        initTransactionCheckboxHandler();
        initMapInputComponents();
        initTimepickerComponents();
        initTransactionModalHandler();
        initContactModalHandler();
        initCleaningServicesModalHandler();
        initNotificationsModalHandler();
        initDeleteImageModalHandler();
        initCalendarModalHandler();
        initTooltip();

        initCleaningMonthlyBatchEvents();

        initBalancesFinishedHandler();
        initBulkTransactionsHandler();

        initDeleteSelectableCheckbox();

        reservationTransactionCalculator();

        orderingImages();
    }

    function printTable(table, title) {
        var tableContent = document.getElementById(table).innerHTML;
        var a = window.open("", "", "height=500, width=500");
        a.document.write("<html>");
        a.document.write("<body>");
        a.document.write(`<h2>${title}</h2>`);
        a.document.write("<style>");
        a.document.write(`
            .not-print{
                display: none !important;
            }

            table{
                width: 100%;
                display: table;
                border-collapse: collapse;
                box-sizing: border-box;
                border-spacing: 2px;
                border-color: grey;
                border-collapse: collapse;
                border-spacing: 2px;
            }

            tr {
                display: table-row;
                vertical-align: inherit;
                border-color: inherit;
            }

            table thead th {
                vertical-align: bottom;
            }

            table th, table td {
                text-align: left;
                font-size: 12px;
                padding: 10px;
                vertical-align: top;
                border: 1px solid #000;
            }

            table th span.app-price-red,
            table td span.app-price-red {
                color: #f00;
            }
        `);

        a.document.write("</style>");
        a.document.write(tableContent);
        a.document.write("</body></html>");
        a.document.close();
        a.print();
    }

    $(".btn-print").on("click", function(e) {
        let tableID = $(this).data("table");
        let tableTitle = $(this).data("title");
        printTable(tableID, tableTitle);
    });

    function resize() {
        viewport = getViewport();
        handleMenuFit();
    }

    /////////////////////////////
    /////////////////////////////

    init();

    /////////////////////////////
    /////////////////////////////
    $("select[name='city_id']").change(function() {
        $("select[name='zone_id']").empty();
        $.getJSON("/system/settings/zones/list/" + $(this).val(), function(
            data
        ) {
            $.each(data.data, function(key, value) {
                $("select[name='zone_id']").append(
                    "<option value=" +
                        value.zone_id +
                        ">" +
                        value.name +
                        "</option>"
                );
            });
        });
    });

    $("#cleaning-option-batch-year-select").change(function() {
        $(this)
            .closest("form")
            .submit();
    });

    $("#cleaning-option-batch-staff-select").change(function() {
        $(this)
            .closest("form")
            .submit();
    });

    const maidFee = $("#field_cleaning-service_maid_fee_").val();
    $("#field_property_status_ids_").change(function() {
        if ($.inArray("8", $(this).val()) != -1) {
            $("#field_cleaning-service_maid_fee_").val(0);
        } else {
            $("#field_cleaning-service_maid_fee_").val(maidFee);
        }
        setTimeout(function() {
            $(".fstChoiceRemove").each(function() {
                $(this).on("click", function() {
                    let text = $(this)
                        .parent(".fstChoiceItem")
                        .data("value");
                    if (text === 8) {
                        $("#field_cleaning-service_maid_fee_").val(maidFee);
                    }
                });
            });
        }, 500);
    });

    $(".fstChoiceRemove").each(function() {
        $(this).on("click", function() {
            let text = $(this)
                .parent(".fstChoiceItem")
                .data("value");
            if (text === 8) {
                $("#field_cleaning-service_maid_fee_").val(maidFee);
            }
        });
    });
    
    // SHOW/HIDE Inputs from template
    $("select[name='template']").change(function () {
        let currentTemplate = $(this).val();
        $('.dynamic-fields').hide();
        selectTemplate(currentTemplate);
    });

    selectTemplate($("select[name='template']").val());

    function selectTemplate(currentTemplate){
        switch (currentTemplate) {
            case 'Payment Methods':
                $('#fields-payment-methods').show();
                break;
            case 'Accidental Rental Damage Insurance (ARDI)':
                $('#fields-accidental').show();
                break;
            case 'Nuevo Vallarta':
                $('#fields-nuevo-vallarta').show();
                break;
            case 'Testimonials':
                $('#fields-testimonials').show();
                break;
            case 'Real Estate Business Directory':
                $('#fields-real-estate').show();
                break;
            default:
                break;
        }
    }

    /////////////////////////////
    /////////////////////////////

    function initCleaningMonthlyBatchEvents() {
        $(".hover-action").each(function() {
            var item = $(this);

            item.click(function() {
                $(".clicked").each(function(i, v) {
                    $(v).removeClass("clicked");
                });
                var tr = $(this).closest("tr");

                if (tr.length) {
                    if (tr.hasClass("clicked")) {
                        tr.removeClass("clicked");
                    } else {
                        tr.addClass("clicked");
                    }
                }
            });
        });
    }
    /////////////////////////////
    //Form for create new user//
    /////////////////////////////
    function modalForm(form) {
        var modal_form = false;
        $(document).on("submit", form, function(e) {
            e.preventDefault();
            var form = $(this);

            if (!modal_form) {
                // modal_form = true;
                var action = $(this).attr("action");
                var req = $(this).serializeArray();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: action,
                    dataType: "json",
                    data: req
                })
                    .done(function(data) {
                        $(".modal-backdrop").fadeOut();
                        $(".modal").fadeOut();
                        $("body").removeClass("modal-open");
                        $("#errors-modal").fadeOut();
                        $.each(data.users.data, function(key, value) {
                            $("select[name='user_id']").append(
                                `<option value="${value.id}">${value.profile.firstname} ${value.profile.lastname}</option>`
                            );
                        });
                        $("select[name='user_id']").append(
                            `<option value="${data.user.user_id}" selected>${data.user.firstname} ${data.user.lastname}</option>`
                        );
                        modal_form = false;
                    })
                    .fail(function(error) {
                        console.log(error);
                        const errors = JSON.parse(error.responseText).errors;
                        $("#errors-modal").empty();
                        $.each(errors, function(key, value) {
                            $("#errors-modal").fadeIn(() => {
                                $("#errors-modal").append(`<li>${value}</li>`);
                            });
                        });
                    });
            }
        });
    }
    modalForm("#store-ajax");
    ///////////////////////////////
    //Verify Day for Sundar Bonus//
    ///////////////////////////////
    function changeProperty() {
        $("#field_cleaning-service_property_id_").change(function() {
            let date = new Date($("input[name='date_submit']").val()).getDay();
            // getBonus($(this).val(), date);
        });
    }
    changeProperty();


    function initBalancesFinishedHandler() {
        var trigger = $("#show_finished_balances");

        var toggle = () => {
            var status = trigger.data('status');
            var isOpened = status === 'open';

            if(isOpened) {
                $(".tr-finished-balance").hide();
                trigger.data('status', 'closed');
                var showText = trigger.data('show-text');
                trigger.text(showText);
            }else{
                $(".tr-finished-balance").show();
                trigger.data('status', 'open');
                var hideText = trigger.data('hide-text');
                trigger.text(hideText);
            }
        }

        toggle();

        trigger.on('click', function(e) {
            e.preventDefault();
            toggle();
        });
    }

    function initBulkTransactionsHandler() {
        $("#bulk-transaction-name").on('change', function() {
            var value = $(this).val();
            $(".bulk-transaction-name").val(value);
        });

        $("#bulk-transaction-type").on('change', function() {
            var value = $(this).val();
            $(".bulk-transaction-type").val(value);
        });

        $("#bulk-transaction-from-date").on('change', function() {
            var value = $(this).val();

            // $(".bulk-transaction-from-date").val(value);
            $(".bulk-transaction-from-date").each(function(){
                var picker = $(this).pickadate('picker');
                picker.set('select', value);
            });
        });

        $("#bulk-transaction-to-date").on('change', function() {
            var value = $(this).val();

            // $(".bulk-transaction-to-date").val(value);
            $(".bulk-transaction-to-date").each(function(){
                var picker = $(this).pickadate('picker');
                picker.set('select', value);
            });
        });

        $("#bulk-transaction-post-date").on('change', function() {
            var value = $(this).val();

            // $(".bulk-transaction-post-date").val(value);
            $(".bulk-transaction-post-date").each(function(){
                var picker = $(this).pickadate('picker');
                picker.set('select', value);
            });
        });

        $("#bulk-transaction-notes").on('change', function() {
            var value = $(this).val();
            $(".bulk-transaction-notes").val(value);
        });
    }

    // submit form balance property management transactions when year change
    $('.select-year').on('change', function(){
        $('#search-balance').submit();
    });

    // fill textarea canvas
    const oldText = $("#text-canvas").val();
    const svgx = document.createElementNS('http://www.w3.org/2000/svg', 'svg');

    const firstText = nl2br($('#field_notification_owners_email_content_').val());
    
    $("#text-canvas").append(firstText);
    $('#field_notification_owners_email_content_').on('change', function(){
        $("#text-canvas").empty();
        $("#text-canvas").append(oldText);
        $("#text-canvas").append(nl2br($(this).val()));
    });

    // email generate image
    $('#send_email').on('submit', function(e){
        var htmlCanvas = document.getElementById("text-canvas");
        var urlCanvas = $(this).attr('data-img');
        var paymentId = $(this).attr('data-payment');

        nodeToDataURL({
            targetNode: htmlCanvas,
            customStyle: '#text-canvas {box-sizing: border-box; font-family: "Open Sans", sans-serif; font-weight: 400; letter-spacing: 0.3px; background-color:#ffffff; padding: 20px 30px; height: 100% !important; width:100% !important;}'
        })
        .then((url) => {
            var dataCanvas = {
                'id': paymentId,
                'image' : url,
            };
            $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                )
            },
            type: "POST",
            url: urlCanvas,
            dataType: "json",
            data:{"source": dataCanvas}
            });
        })
    });

    function calcHeight(value) {
        let numberOfLineBreaks = (value.match(/\n/g) || []).length;
        // min-height + lines x line-height + padding + border
        let newHeight = 20 + numberOfLineBreaks * 25 + 12 + 2;
        return newHeight;
    }

    function nl2br (str, is_xhtml) {     
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br/>' : '<br>';      
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');  
    }

    if($('html')[0].lang == 'en'){
        var labelLegend      = "Select the bedroom accordingly to what the property has.<br/>* Use 'Main bathroom' for Studios.<br/>* Use 'Master bedroom bathroom' and 'Guest bedroom bathroom' for properties with two bedrooms.";
        var labelBedroom     = "BEDROOM";
        var labelBathroom    = "BATHROOM";
        var labelBedding     = "Bedding area";
        var labelMaster      = "Master bedroom";
        var labelGuest       = "Guest bedroom";
        var labelTwoBed      = "Two bed bedroom";
        var labelBunkBed     = "Bunk bed bedroom";
        var labelType        = "Type";
        var labelMainBath    = "Main bathroom";
        var labelMasterBath  = "Master bedroom bathroom";
        var labelGuestBath   = "Guest bedroom bathroom";
        var labelTwoBedBath  = "Two bed bedroom bathroom";
        var labelBunkBedBath = "Bunk bed bedroom bathroom";
        var labelDoor        = "Door";
        var labelCeiling     = "Ceiling";
        var labelWalls       = "Walls and trim";
        var labelFloor       = "Floor";
        var labelCabinet     = "Cabinets and mirrors";
        var labelClosets     = "Closet(s)";
        var labelSafety      = "Safety box (in good condition/working/batteries)";
        var labelTub         = "Tub, shower, taps, stopper";
        var labelLighting    = "Lighting fixtures, ceiling fans and light bulbs";
        var labelWindows     = "Windows, coverings and screens";
        var labelSink        = "Sink, stopper, taps";
        var labelStock       = "Stock: Toilet paper, hand soap, tissue, odor spray";
        var labelHotTub      = "Hot tub";
        var labelBed         = "Bed mattresses/headboards (in good condition/no stains)";
        var labelSheets      = "Sheets/pillowcases (in good condition and appropriate quantity)";
        var labelComforters  = "Comforters/blankets (in good condition and appropriate quantity)";
        var labelPillows     = "Pillows (in good shape and appropriate quantity)";
        var labelElectronics = "Electronics (TV, alarm clock, etc.)";
        var labelFurniture   = "Furniture (in good condition)";
        var labelElectrical  = "Electrical outlets";
        var labelShower      = "Shower door, floor and walls";
        var labelCarpets     = "Carpets, mats";
        var labelAir         = "Air conditioner/cover";
        var labelRemote      = "All remote controls/batteries";
        var labelComments    = "Comments";
        var labelAttention   = "Attention";
        var labelRemove      = "Remove";
    }else{
        var labelLegend      = "Seleccione el dormitorio de acuerdo con lo que tiene la propiedad.<br/>* Use 'Área de ropa de cama' para estudios.<br/>* Use 'Dormitorio principal' y 'Habitación de invitados' para propiedades con dos dormitorios.";
        var labelBedroom     = "HABITACIÓN";
        var labelBathroom    = "BAÑO";
        var labelType        = "Tipo";
        var labelBedding     = "Área de ropa de cama";
        var labelMaster      = "Recamara principal";
        var labelGuest       = "Cuarto de huéspedes";
        var labelTwoBed      = "Dormitorio de dos camas";
        var labelBunkBed     = "Dormitorio con litera";
        var labelMainBath    = "Baño principal";
        var labelMasterBath  = "Baño del dormitorio principal";
        var labelGuestBath   = "Baño de la habitación de invitados";
        var labelTwoBedBath  = "Baño de dos dormitorios";
        var labelBunkBedBath = "Cuarto de baño del dormitorio con literas";
        var labelDoor        = "Puerta";
        var labelCeiling     = "Techo";
        var labelWalls       = "Paredes y molduras";
        var labelFloor       = "Piso";
        var labelCabinet     = "Armarios y espejos";
        var labelClosets     = "Armario(s)";
        var labelSafety      = "Caja de seguridad (en buen estado/funcionando/baterías)";
        var labelTub         = "Bañera, ducha, grifería, tapón";
        var labelLighting    = "Accesorios de iluminación, ventiladores de techo y bombillas";
        var labelWindows     = "Ventanas, revestimientos y mamparas";
        var labelSink        = "Fregadero, tapón, grifos";
        var labelStock       = "Existencias: Papel higiénico, jabón de manos, pañuelos desechables, spray antiolor";
        var labelHotTub      = "Bañera de hidromasaje";
        var labelBed         = "Colchones/cabeceros de cama (en buen estado/sin manchas)";
        var labelSheets      = "Sábanas/fundas de almohada (en buen estado y cantidad adecuada)";
        var labelComforters  = "Edredones/cobijas (en buen estado y cantidad adecuada)";
        var labelPillows     = "Almohadas (en buen estado y cantidad adecuada)";
        var labelElectronics = "Electrónica (TV, despertador, etc.)";
        var labelFurniture   = "Mobiliario (en buen estado)";
        var labelElectrical  = "Enchufes electricos";
        var labelShower      = "Mampara, suelo y paredes de la ducha";
        var labelCarpets     = "Alfombras, esteras";
        var labelAir         = "Aire acondicionado/cubierta";
        var labelRemote      = "Todos los controles remotos/baterías";
        var labelComments    = "Comentarios";
        var labelAttention   = "Atención";
        var labelRemove      = "Remover";
    }
    
      function addBedroom(container, current){
        var newItem = $(`<div class="container-bedroom card-body">
            <span class="badge badge-primary r-badge mb-4">${labelBedroom}</span>
            <div>${labelLegend}</div>
            <br/>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelType}
                </label>
    
                <div class="col-sm-10">
                    <select name="bedroomsList[${current}][type_bedroom]" class="form-control">
                            <option value="Bedding area">
                                ${labelBedding}
                            </option>
                            <option value="Master bedroom">
                                ${labelMaster}
                            </option>
                            <option value="Guest bedroom">
                                ${labelGuest}
                            </option>
                            <option value="Two bed bedroom">
                                ${labelTwoBed}
                            </option>
                            <option value="Bunk bed bedroom">
                                ${labelBunkBed}
                            </option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelDoor}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][door_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][door_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][door_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelCeiling}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][ceiling_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][ceiling_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][ceiling_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelWalls}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][walls_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][walls_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][walls_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelFloor}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][floor_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][floor_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][floor_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelClosets}
                </label>

                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][closets_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][closets_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][closets_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelLighting}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][lighting_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][lighting_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][lighting_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelWindows}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][windows_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][windows_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][windows_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelBed}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][bed_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][bed_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][bed_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelSheets}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][sheets_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][sheets_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][sheets_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelComforters}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][comforters_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][comforters_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][comforters_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelPillows}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][pillows_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][pillows_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][pillows_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelElectronics}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][electronics_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][electronics_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][electronics_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelFurniture}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][furniture_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][furniture_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][furniture_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelElectrical}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][electrical_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][electrical_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][electrical_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelAir}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][air_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][air_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][air_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelRemote}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bedroomsList[${current}][remote_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bedroomsList[${current}][remote_bedroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bedroomsList[${current}][remote_bedroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    ${labelComments}
                </label>
    
                <div class="col-sm-10">
                    <textarea name="bedroomsList[${current}][comments_bedroom]" class="form-control ckeditor" rows="3" style="resize: none;"></textarea>
                </div>
            </div>
            <a href="#" class="btn-remove-bedroom btn  btn-secondary m-1">
                ${labelRemove}
            </a>
        </div>`);
        $(container).append(newItem);
      }
    
      $('#btn-add-bedroom').on('click', function(e){
        e.preventDefault();
        if($('.container-bedrooms .card-body')){
              var currentBedrooms = $('.container-bedrooms .card-body').length;
            var currentBedroom = currentBedrooms+1;
        }else{
            var currentBedroom = 1;
        }
          addBedroom('.container-bedrooms', currentBedroom);
      });
    
      $('.btn-remove-bedroom').on('click', function(e){
        e.preventDefault();
        $(this).closest('.container-bedroom').remove();
      });
    
    
      function addBathroom(container, current){
        var newItem = $(`<div class="container-bathroom card-body">
            <span class="badge badge-primary r-badge mb-4">${labelBathroom}</span>
            <div>${labelLegend}</div>
            <br/>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelType}
                </label>
    
                <div class="col-sm-10">
                    <select name="bathroomsList[${current}][type_bathroom]" class="form-control">
                            <option value="Main bathroom">
                                ${labelMainBath}
                            </option>
                            <option value="Master bedroom bathroom">
                                ${labelMasterBath}
                            </option>
                            <option value="Guest bedroom bathroom">
                                ${labelGuestBath}
                            </option>
                            <option value="Two bed bedroom bathroom">
                                ${labelTwoBedBath}
                            </option>
                            <option value="Bunk bed bedroom bathroom">
                                ${labelBunkBedBath}
                            </option>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelDoor}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][door_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][door_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][door_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelCeiling}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][ceiling_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][ceiling_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][ceiling_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelWalls}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][walls_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][walls_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][walls_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelFloor}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][floor_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][floor_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][floor_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelCabinet}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][cabinet_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][cabinet_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][cabinet_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelClosets}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][closets_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][closets_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][closets_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelSafety}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][safety_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][safety_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][safety_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelTub}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][tub_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][tub_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][tub_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelLighting}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][lighting_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][lighting_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][lighting_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelWindows}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][windows_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][windows_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][windows_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelSink}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][sink_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][sink_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][sink_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelStock}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][stock_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][stock_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][stock_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelHotTub}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][hottub_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][hottub_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][hottub_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelElectrical}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][electrical_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][electrical_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][electrical_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelShower}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][shower_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][shower_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][shower_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-sm-2 col-form-label">
                    ${labelCarpets}
                </label>
    
                <div class="col-sm-10">
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="1" name="bathroomsList[${current}][carpets_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            OK
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="2" name="bathroomsList[${current}][carpets_bathroom]">
                        <span class="checkmark app-checkmark"></span><div class="app-form-checkbox-label">
                            ${labelAttention}
                        </div>
                    </label>
                    <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                        <input type="radio" value="3" name="bathroomsList[${current}][carpets_bathroom]">
                        <span class="checkmark app-checkmark"></span>
                        <div class="app-form-checkbox-label">
                            N/A
                        </div>
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">
                    ${labelComments}
                </label>
    
                <div class="col-sm-10">
                    <textarea name="bathroomsList[${current}][comments_bathroom]" class="form-control ckeditor" rows="3" style="resize: none;"></textarea>
                </div>
            </div>
            <a href="#" class="btn-remove-bathroom btn  btn-secondary m-1">
                ${labelRemove}
            </a>
        </div>`);
        $(container).append(newItem);
      }
    
        $('#btn-add-bathroom').on('click', function(e){
            e.preventDefault();
            if($('.container-bathrooms .card-body')){
                var currentBathrooms = $('.container-bathrooms .card-body').length;
                var currentBathroom = currentBathrooms+1;
            }else{
                var currentBathroom = 1;
            }
            addBathroom('.container-bathrooms', currentBathroom);
        });
    
        $('.btn-remove-bathroom').on('click', function(e){
            e.preventDefault();
            $(this).closest('.container-bathroom').remove();
        });
});
