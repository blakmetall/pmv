import { initConfirmClick } from "./scripts/initConfirmClick.js";
import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { initCalendar } from "./scripts/initCalendar.js";
import { initDatepickerComponents } from "./scripts/initDatepickerComponents.js";
import { initFastSelectComponents } from "./scripts/initFastSelectComponents.js";
import { initGetPmPropertySelectionEvent } from "./scripts/initGetPmPropertySelectionEvent.js";
import { initTransactionCheckboxHandler } from "./scripts/initTransactionCheckboxHandler.js";
import { initMapInputComponents } from "./scripts/initMapInputComponents.js";
import { initTimepickerComponents } from "./scripts/initTimepickerComponents.js";
import { initTransactionModalHandler } from "./scripts/initTransactionModalHandler.js";
import { initContactModalHandler } from "./scripts/initContactModalHandler.js";
import { initTooltip } from "./scripts/initTooltip.js";

$(function () {
    /////////////////////////////
    /////////////////////////////

    var viewport = {
        x: 0,
        y: 0,
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
        initTransactionCheckboxHandler();
        initMapInputComponents();
        initTimepickerComponents();
        initTransactionModalHandler();
        initContactModalHandler();
        initTooltip();
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

    $(".btn-print").on("click", function (e) {
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
});
