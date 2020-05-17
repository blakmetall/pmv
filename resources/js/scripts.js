import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";
import { multiSelect } from "./scripts/multiSelect.js";

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
