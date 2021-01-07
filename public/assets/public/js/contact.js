(function($){
    function waitForGoogleAndInit() {
        var googleCheckInterval = setInterval(function() {
            if (typeof google === 'object' && typeof google.maps === 'object') {
                init();
                clearInterval(googleCheckInterval);
            }
        }, 500);
    }
    
    function init() {
        var maps = $('.app-map-wrapper');
        if(maps.length) {
            maps.each(function() {
                var container = $(this);
                var mapWrapper = container.find('.app-google-map');
                var marker;
                var mapId = mapWrapper.data('map-id');
                var mapElem = document.getElementById(mapId);
        
                var dataLat = mapWrapper.data('lat');
                var dataLng = mapWrapper.data('lng');
        
                var position = {
                    lat: dataLat || 20.666155,
                    lng: dataLng || -105.251954
                };
        
                var map = new google.maps.Map(mapElem, {
                    center: position,
                    zoom: 12,
                });
        
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                });
        
                if(!dataLat && !dataLng) {
                    marker.setMap(null);
                }
            });
        }
    };

    waitForGoogleAndInit();

    var colours = ["#000000", "#FF0000", "#990066", "#FF9966", "#996666", "#CC9933"];
    var sizes = ["30px", "35px", "40px"];
    var rotations = ["-20deg", "-15deg", "-10deg", "0deg", "10deg", "15deg", "20deg"];
    $(function() {
        var div = $('.captcha-code'); 
        var chars = div.text().split('');
        div.html('');     
        for(var i=0; i<chars.length; i++) {
            idx = Math.floor(Math.random() * colours.length);
            idxS = Math.floor(Math.random() * sizes.length);
            idxR = Math.floor(Math.random() * rotations.length);
            var span = $('<span>' + chars[i] + '</span>').css({
                "color": colours[idx],
                "font-size": sizes[idxS],
                "float": 'left',
                "-webkit-transform": "rotate("+rotations[idxR]+")"
            });
            div.append(span);
        }
    });
})(jQuery)