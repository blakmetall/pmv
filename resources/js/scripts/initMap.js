export function initMap() {
    var getMap = document.getElementById('map');
    var getLat = $('#map').data('lat');
    var getLng = $('#map').data('lng');
    var latitude = (getLat)?getLat:20.666155;
    var longitude = (getLng)?getLng:-105.251954;
    var position = {lat: latitude, lng: longitude};
    var fieldLat = $("#field_property_gmaps_lat_");
    var fieldLng = $("#field_property_gmaps_lon_");

    $(fieldLat).val(latitude);
    $(fieldLng).val(longitude);

    var map = new google.maps.Map(getMap, {
        center: position,
        zoom: 12,
        disableDefaultUI: true
    });

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        draggable:true,
    });

    google.maps.event.addListener(marker, 'dragend', function (evt) {
        $(fieldLat).val(evt.latLng.lat().toFixed(6));
        $(fieldLng).val(evt.latLng.lng().toFixed(6));

        map.panTo(evt.latLng);
    });
}
