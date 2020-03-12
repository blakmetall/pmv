import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";

$(function() {
    /////////////////////////////
    /////////////////////////////

    var viewport = { x: 0, y: 0 };

    /////////////////////////////
    /////////////////////////////

    function init() {
        $(window).resize(resize);
        handleMenuFit();
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
