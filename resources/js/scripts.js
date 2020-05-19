import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { multiSelect } from "./scripts/multiSelect.js";
import { initCalendar } from "./scripts/initCalendar.js";
import { initMap } from "./scripts/initMap.js";

$(function() {
    /////////////////////////////
    /////////////////////////////

    var viewport = { x: 0, y: 0 };

    /////////////////////////////
    /////////////////////////////

    function init() {
        $(window).resize(resize);
        handleMenuFit();

        $.each( $(".field_multiselect"), function( key, value ) {
            multiSelect(value);
        });
      
        initCalendar();
        initMap();
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
