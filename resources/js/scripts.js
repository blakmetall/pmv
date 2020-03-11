import { getViewport } from "./scripts/getViewport.js";
import { handleMenuFit } from "./scripts/handleMenuFit.js";

$(function() {
    /////////////////////////////
    /////////////////////////////

    var viewport = { x: 0, y: 0 };

    /////////////////////////////
    /////////////////////////////

    function resizeInit() {
        $(window).resize(resize);
    }

    function resize() {
        viewport = getViewport();
        logViewport();
        handleMenuFit();
    }

    function logViewport() {
        console.log(viewport);
    }

    /////////////////////////////
    /////////////////////////////

    resizeInit();

    /////////////////////////////
    /////////////////////////////
});
