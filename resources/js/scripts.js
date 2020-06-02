import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { initCalendar } from "./scripts/initCalendar.js";
import { initFastSelectComponents } from "./scripts/initFastSelectComponents.js";
import { initMapInputComponents } from "./scripts/initMapInputComponents.js";
import { initTimePickerComponents } from "./scripts/initTimePickerComponents.js";

$(function() {
    /////////////////////////////
    /////////////////////////////

    var viewport = { x: 0, y: 0 };

    /////////////////////////////
    /////////////////////////////

    function init() {
        $(window).resize(resize);
        handleMenuFit();
      
        initCalendar();

        initFastSelectComponents();
        initMapInputComponents();
        initTimePickerComponents();
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
