$(document).ready(function () {
	var dataLHP, gridLHP, eDataLHP, eGridLHP, tempData;
    dataLHP = [{ 'No': 1, 'Keterangan': 'No Data Yet'}];
	try {
		eDataLHP = JSON.parse($('#eTempLHP').val());
	}catch(error){
		eDataLHP = dataLHP;
	}
	
	eGridLHP = $('#eGridLHP').grid({
        dataKey: "No",
		dataSource: eDataLHP,
		columns: [
            { field: 'No', width: 32, align: 'center', color: 'green'},
            { field: 'Keterangan' },
        ]
    });
	
	function showResult(result) {
    document.getElementById('latitude').value = result.geometry.location.lat();
    document.getElementById('longitude').value = result.geometry.location.lng();
}

function getLatitudeLongitude(callback, address) {
    // If adress is not supplied, use default value 'Ferrol, Galicia, Spain'
    address = address || 'Ferrol, Galicia, Spain';
    // Initialize the Geocoder
    geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0]);
            }
        });
    }
}
/*
var button = document.getElementById('btn');

button.addEventListener("click", function () {
    var address = document.getElementById('address').value;
    getLatitudeLongitude(showResult, address)
}); */

$('#btn').on('click', function () {
        var address = $('#address').val();
		getLatitudeLongitude(showResult, address);
    });
	
});