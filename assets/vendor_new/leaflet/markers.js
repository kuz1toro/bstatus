// locetion picker
// method 1
function onMapClick(e) {
  map.removeLayer(markers);
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

map.on('click', onMapClick);

// method 2
map.on('click', function(e) {
  var marker = L.marker(new L.LatLng(e.latlng.lat, e.latlng.lng), { icon: redIcon });
  markers.addLayer(marker);
  map.addLayer(markers);
});






