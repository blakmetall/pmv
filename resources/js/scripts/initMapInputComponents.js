export function initMapInputComponents() {
    var maps = $('.app-map-wrapper');

    function placeMarker(event, marker, map ) {
        if (marker){
            marker.setPosition(event.latLng);
        }else{
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                draggable:true,
            });
        }
        marker.setMap(map);
        map.panTo(event.latLng);
    }
    
    function fillInputs(event, latitudeInput, longitudeInput) {
        latitudeInput.val(event.latLng.lat());
        longitudeInput.val(event.latLng.lng());
    }

    function waitForGoogleAndInit() {
        var googleCheckInterval = setInterval(function() {
            if (typeof google === 'object' && typeof google.maps === 'object') {
                init();
                clearInterval(googleCheckInterval);
            }
        }, 500);
    }
    
    function init() {
        if(maps.length) {
            maps.each(function() {
                var container = $(this);
                var mapWrapper = container.find('.app-google-map');
                var mapResetBtn = container.find('.app-google-clear-map');
                var marker;
    
                var mapId = mapWrapper.data('map-id');
                var mapElem = document.getElementById(mapId);
    
                var latitudeInput = container.find('.latitude-wrapper input');
                var longitudeInput = container.find('.longitude-wrapper input');

                var isDisabled = !!mapWrapper.data('disabled') || !!mapWrapper.data('read-only');
    
                var dataLat = mapWrapper.data('lat');
                var dataLng = mapWrapper.data('lng');
    
                var position = {
                    lat: dataLat || 20.666155,
                    lng: dataLng || -105.251954
                };

                var map = new google.maps.Map(mapElem, {
                    center: position,
                    zoom: 12,
                    streetViewControl: false,
                    fullscreenControl: false,    
                });

                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    draggable: true,
                });
                
                if(!dataLat && !dataLng) {
                    marker.setMap(null);
                }
                
                if(!isDisabled) {
                    if(mapResetBtn.length) {
                        mapResetBtn.on('click', function(){
                            marker.setMap(null);
                            latitudeInput.val('');
                            longitudeInput.val('');
                        });
                    }
                    
                    google.maps.event.addListener(map, 'click', function (e) {
                        placeMarker(e, marker, map);
                        fillInputs(e, latitudeInput, longitudeInput);
                    });

                    google.maps.event.addListener(marker, 'dragend', function(e) {
                        placeMarker(e, marker, map);
                        fillInputs(e, latitudeInput, longitudeInput);
                    });
                }

                // 
                const geocoder = new google.maps.Geocoder();
                var search = container.find('.app-search-map input');

                function geocodeAddress(address, geocoder) {
                    geocoder.geocode({ address: address }, (results, status) => {
                        if (status === "OK") {
                            placeMarker({latLng: results[0].geometry.location}, marker, map);
                            fillInputs({latLng: results[0].geometry.location}, latitudeInput, longitudeInput);
                        } else {
                            console.log("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
                    
                var getCoderSearch = null;

                search.on('keyup', function(e){
                    if(e.keyCode == '13') {
                        return false;
                    }

                    clearTimeout(getCoderSearch);
                    getCoderSearch = setTimeout(function() {
                        geocodeAddress(e.target.value, geocoder);
                    }, 350)
                });
            });
        }
    }

    waitForGoogleAndInit();
}
