import { initConfirmClick } from "./scripts/initConfirmClick.js";
import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { initCalendar } from "./scripts/initCalendar.js";
import { getBonus } from "./scripts/getBonus.js";
import { initDatepickerComponents } from "./scripts/initDatepickerComponents.js";
import { initFastSelectComponents } from "./scripts/initFastSelectComponents.js";
import { initGetPmPropertySelectionEvent } from "./scripts/initGetPmPropertySelectionEvent.js";
import { initTransactionCheckboxHandler } from "./scripts/initTransactionCheckboxHandler.js";
import { initMapInputComponents } from "./scripts/initMapInputComponents.js";
import { initTimepickerComponents } from "./scripts/initTimepickerComponents.js";
import { initTransactionModalHandler } from "./scripts/initTransactionModalHandler.js";
import { initContactModalHandler } from "./scripts/initContactModalHandler.js";
import { initCleaningServicesModalHandler } from "./scripts/initCleaningServicesModalHandler.js";
import { initTooltip } from "./scripts/initTooltip.js";

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
        initGetPmPropertySelectionEvent("#app-pm-property-selection-modal", "#app-pm-property-selection-container", "generate-pm-transaction-url");
        initGetPmPropertySelectionEvent("#app-property-bookings-selection-modal", "#app-property-bookings-selection-container", "generate-booking-url");
        initTransactionCheckboxHandler();
        initMapInputComponents();
        initTimepickerComponents();
        initTransactionModalHandler();
        initContactModalHandler();
        initCleaningServicesModalHandler();
        initTooltip();

        initCleaningMonthlyBatchEvents();
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
});
