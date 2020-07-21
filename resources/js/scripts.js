import {
    initConfirmClick
} from "./scripts/initConfirmClick.js";
import {
    getViewport
} from "./scripts/getViewport.js";
import {
    handleMenuFit
} from "./scripts/handleMenuFit.js";
import {
    initCalendar
} from "./scripts/initCalendar.js";
import {
    initDatepickerComponents
} from "./scripts/initDatepickerComponents.js";
import {
    initFastSelectComponents
} from "./scripts/initFastSelectComponents.js";
import {
    initGetPmPropertySelectionEvent
} from "./scripts/initGetPmPropertySelectionEvent.js";
import {
    initTransactionCheckboxHandler
} from "./scripts/initTransactionCheckboxHandler.js";
import {
    initMapInputComponents
} from "./scripts/initMapInputComponents.js";
import {
    initTimepickerComponents
} from "./scripts/initTimepickerComponents.js";
import {
    initTransactionModalHandler
} from "./scripts/initTransactionModalHandler.js";
import {
    initTooltip
} from "./scripts/initTooltip.js";

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
        initTransactionCheckboxHandler();
        initMapInputComponents();
        initTimepickerComponents();
        initTransactionModalHandler();
        initTooltip();
    }

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