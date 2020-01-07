// See post: http://asmaloney.com/2014/01/code/creating-an-interactive-map-with-leaflet-and-openstreetmap/
$("a[href='#peta']").on('shown.bs.tab', function(e) {
  var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
  }),
  latlng = L.latLng(latGdg, lonGdg);

  var map = L.map('map', {center: latlng, zoom: 14, layers: [tiles]});

  var markers = L.markerClusterGroup();

  function loadContent(){
    var dataString = 'idGdg='+ idGdg;
    $.ajax({
          type: "POST",
          dataType: "json",
      url: base_url + "dinas/loadMapDatabyId",
      data: dataString ,
      cache: false,
      success: function(result){
        handleResponse(result);
      }
    });
  };
    
  var greenIcon = L.icon({
    iconUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin24-green.png',
    iconRetinaUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin48-green.png',
    iconSize: [29, 24],
    iconAnchor: [9, 21],
    popupAnchor: [0, -14]
  })

  var yellowIcon = L.icon({
    iconUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin24-yellow.png',
    iconRetinaUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin48-yellow.png',
    iconSize: [29, 24],
    iconAnchor: [9, 21],
    popupAnchor: [0, -14]
  })

  var redIcon = L.icon({
    iconUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin24-red.png',
    iconRetinaUrl: base_url + 'assets/vendor_new/leaflet/leaflet/images/pin48-red.png',
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
    //addressPoints = JSON.parse(data);
    //console.log(data);
    for (var i = 0; i < data.length; i++) {
      var a = data[i];
      var no_gedung = a.no_gedung ;
      var nama_gedung = a.nama_gedung;
      var kepemilikkan = a.kepemilikkan_gedung;
      var fungsi = a.fungsi_gedung;
      var jml_lantai = a.jml_lantai;
      var Jml_basement = a.jml_basement;
      var status = a.nama_kolom_statusGedung;
      var customPopup = "<b>No Gedung : "+no_gedung+"</b><br/><b>Nama Gedung : "+nama_gedung+"</b><br/><b>Kepemilikkan : "+kepemilikkan+"</b><br/><b>Fungsi : "+fungsi+"</b><br/>";
      var customPopup = customPopup +"<b>Lantai : "+jml_lantai+"</b><br/><b>Basement : "+Jml_basement+"</b><br/><b>Status : "+status+"</b>";
      var customOptions =
      {
      'maxWidth': '400',
      'width': '200',
      'className' : 'popupCustom'
      }
      var marker = L.marker(new L.LatLng(a.latitude, a.longitude), { icon: greenIcon });
      marker.bindPopup(customPopup, customOptions);
      //marker.bindPopup(title);
      markers.addLayer(marker);
    }
    map.addLayer(markers);
  }

  loadContent();
//map.invalidateSize();


  //console.log('show - before the new tab has been shown');
 // map.invalidateSize();
});

