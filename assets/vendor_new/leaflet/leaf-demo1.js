// See post: http://asmaloney.com/2014/01/code/creating-an-interactive-map-with-leaflet-and-openstreetmap/
var cities = L.layerGroup();

var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

var grayscale   = L.tileLayer(mbUrl, {id: 'mapbox/light-v9', attribution: mbAttr}),
  streets  = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11',   attribution: mbAttr});

latlng = L.latLng(-6.19982, 106.80003);

var map = L.map('map', {
  center: latlng,
  zoom: 12,
  layers: [grayscale, cities]
});

var baseLayers = {
  "Grayscale": grayscale,
  "Streets": streets
};

var overlays = {
  "Cities": cities
};

L.control.layers(baseLayers, overlays).addTo(map);

var markers = L.markerClusterGroup();

function loadContent(){
var xhr = new XMLHttpRequest();
var url = base_url+"welcome/loadData";

xhr.onreadystatechange = function(){
  if(this.readyState == 4 && this.status == 200){
    handleResponse(this.responseText);
  }
};
xhr.open("GET", url, true);
xhr.send();
};
  
var greenIcon = L.icon({
  iconUrl: base_url + 'assets/leaflet/images/pin24-green.png',
  iconRetinaUrl: base_url + 'assets/leaflet/images/pin48-green.png',
  iconSize: [29, 24],
  iconAnchor: [9, 21],
  popupAnchor: [0, -14]
})

var yellowIcon = L.icon({
  iconUrl: base_url + 'assets/leaflet/images/pin24-yellow.png',
  iconRetinaUrl: base_url + 'assets/leaflet/images/pin48-yellow.png',
  iconSize: [29, 24],
  iconAnchor: [9, 21],
  popupAnchor: [0, -14]
})

var redIcon = L.icon({
  iconUrl: base_url + 'assets/leaflet/images/pin24-red.png',
  iconRetinaUrl: base_url + 'assets/leaflet/images/pin48-red.png',
  iconSize: [29, 24],
  iconAnchor: [9, 21],
  popupAnchor: [0, -14]
})
/** 
  addressPoints = JSON.parse(geodata);
    //console.log(data);
    for (var i = 0; i < addressPoints.length; i++) {
      var a = addressPoints[i];
      var title = a.nama_gedung;
      var marker = L.marker(new L.LatLng(a.latitude, a.longitude), { icon: redIcon });
      marker.bindPopup(title);
      markers.addLayer(marker);
    }

    map.addLayer(markers);
*/
function handleResponse(data) {
  addressPoints = JSON.parse(data);
  //console.log(data);
  for (var i = 0; i < addressPoints.length; i++) {
    var a = addressPoints[i];
    var title = a.nama_gedung;
    var marker = L.marker(new L.LatLng(a.latitude, a.longitude), { icon: redIcon });
    marker.bindPopup(title);
    markers.addLayer(marker);
  }

  map.addLayer(markers);
}

loadContent();