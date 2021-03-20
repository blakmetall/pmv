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
})(jQuery)