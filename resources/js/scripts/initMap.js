export function initMap() {
    var maps = $('.app-map-wrapper');

    if(maps.length) {
        maps.each(function() {
            var container = $(this);
            var mapWrapper = container.find('.app-google-map');

            var mapId = mapWrapper.data('map-id');
            var mapElem = document.getElementById(mapId);

            var latitudeInput = container.find('.latitude-wrapper input');
            var longitudeInput = container.find('.longitude-wrapper input');

            var position = {
                lat: mapWrapper.data('lat') || 20.666155, 
                lng: mapWrapper.data('lng') || -105.251954
            };
            
            latitudeInput.val(position.lat);
            longitudeInput.val(position.lng);

            var map = new google.maps.Map(mapElem, {
                center: position,
                zoom: 12,
                disableDefaultUI: true
            });
        
            var marker = new google.maps.Marker({
                position: position,
                map: map,
                draggable:true,
            });
        
            google.maps.event.addListener(marker, 'dragend', function (e) {
                latitudeInput.val(e.latLng.lat());
                longitudeInput.val(e.latLng.lng());
                map.panTo(e.latLng);
            });

            // FALTARIA AGREGAR EL EVENTO CLICK PARA HACER LO MISMO
        })
    }
}
