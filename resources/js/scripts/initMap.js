export function initMap() {
    var maps = $('.app-map-wrapper');
    var marker;

    function placeMarker(position, map, latitudeInput, longitudeInput) {
        if (marker){
            marker.setPosition(position);
        }else{
            marker = new google.maps.Marker({
                position: position,
                map: map,
                draggable:true,
            });
        }
        marker.setMap(map);

        map.panTo(position);

        google.maps.event.addListener(marker, 'dragend', function (e) {
            latitudeInput.val(e.latLng.lat());
            longitudeInput.val(e.latLng.lng());
            map.panTo(e.latLng);
        });
    }

    if(maps.length) {
        maps.each(function() {
            var container = $(this);
            var mapWrapper = container.find('.app-google-map');
            var mapResetBtn = container.find('.reset-google-map');

            var mapId = mapWrapper.data('map-id');
            var mapElem = document.getElementById(mapId);

            var latitudeInput = container.find('.latitude-wrapper input');
            var longitudeInput = container.find('.longitude-wrapper input');
            var dataLat = mapWrapper.data('lat');
            var dataLng = mapWrapper.data('lng');

            var position = {
                lat: dataLat || 20.666155,
                lng: dataLng || -105.251954
            };

            var map = new google.maps.Map(mapElem, {
                center: position,
                zoom: 12,
                disableDefaultUI: true,
                fullscreenControl: false,
            });

            if(dataLat && dataLng){
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    draggable:true,
                });
            }

            $(mapResetBtn).on('click', function(){
                marker.setMap(null);
                latitudeInput.val('');
                longitudeInput.val('');
            });

            google.maps.event.addListener(map, 'click', function (e) {
                placeMarker(e.latLng, map, latitudeInput, longitudeInput);
                latitudeInput.val(e.latLng.lat());
                longitudeInput.val(e.latLng.lng());
            });
        })
    }
}
