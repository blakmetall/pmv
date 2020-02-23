$(function() {

    /////////////////////////////
    /////////////////////////////

    var viewport = {x: 0, y: 0};

    /////////////////////////////
    /////////////////////////////

    function resizeInit() {
        $( window ).resize(resize);
    }

    function resize() {
        viewport = getViewport();
        logViewport();
    }

    function getViewport(){
        var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        return {w: w, h: h};
    }

    function logViewport() {
        console.log(viewport);
    };

    /////////////////////////////
    /////////////////////////////

    resizeInit();

    /////////////////////////////
    /////////////////////////////

});