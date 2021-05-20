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
            getBonus($(this).val(), date);
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
            $(".bulk-transaction-from-date").val(value);
        });

        $("#bulk-transaction-to-date").on('change', function() {
            var value = $(this).val();
            $(".bulk-transaction-to-date").val(value);
        });

        $("#bulk-transaction-post-date").on('change', function() {
            var value = $(this).val();
            $(".bulk-transaction-post-date").val(value);
        });
    }

    // get dates availability
    let getDateAvailability = JSON.parse(localStorage.getItem('dates-availability')) || [];
    let arrivalDateAvailability = (getDateAvailability.length !== 0)?getDateAvailability[0]:'';
    let departureDateAvailability = (getDateAvailability.length !== 0)?getDateAvailability[1]:'';
    $('input[name="arrival_date"]').val(arrivalDateAvailability);
    $('input[name="arrival_date_submit"]').val(arrivalDateAvailability);
    $('input[name="departure_date"]').val(departureDateAvailability);
    $('input[name="departure_date_submit"]').val(departureDateAvailability);

    // submit form balance property management transactions when year change
    $('.select-year').on('change', function(){
        $('#search-balance').submit();
    });

    // fill textarea canvas
    const oldText = $("#text-canvas").val();
    const svgx = document.createElementNS('http://www.w3.org/2000/svg', 'svg');

    const firstText = nl2br($('#field_notification_owners_email_content_').val());
    $("#text-canvas").append(firstText);
    // $("#text-canvas").css({
    //     'height': calcHeight($("#text-canvas").val()) + "px"
    // });
    $('#field_notification_owners_email_content_').on('change', function(){
        $("#text-canvas").empty();
        $("#text-canvas").append(oldText);
        $("#text-canvas").append(nl2br($(this).val()));
        // $("#text-canvas").css({
        //     'height': calcHeight($("#text-canvas").val()) + "px"
        // });
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
});
