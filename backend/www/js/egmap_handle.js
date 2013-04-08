// function to get the latitude and longitude
// and place them on the test fields

var markers = [];

function setLatLngToClass() {
	if (document.getElementById('NationalParks_latitude')) document.getElementById('NationalParks_latitude').value = markers[0].getPosition().lat();
	if (document.getElementById('NationalParks_longitude')) document.getElementById('NationalParks_longitude').value = markers[0].getPosition().lng();
	
	if (document.getElementById('Coordinations_latitude')) document.getElementById('Coordinations_latitude').value = markers[0].getPosition().lat();
	if (document.getElementById('Coordinations_longitude')) document.getElementById('Coordinations_longitude').value = markers[0].getPosition().lng();
}

// geocodes the address inserted
function geocode() {
	var address = document.getElementById("address").value;
	geocoder.geocode({
		'address': address,
		'partialmatch': true
	}, geocodeResult);
}

function geocodeResult(results, status) {
	if (status == 'OK' && results.length > 0) {
		deleteAllMarkers();
		var marker = new google.maps.Marker({
	        position: results[0].geometry.location,
	        map: map,
	        draggable: true,
	        animation: google.maps.Animation.DROP,
	        icon: './images/forest.png',
	    });
		addMarker(marker);
		map.fitBounds(results[0].geometry.viewport);
	} else {
		alert("Không tìm thấy địa điểm này: " + status);
	}
}

function deleteAllMarkers() {
	$.each(markers, function(index) {
		deleteMarker(markers[index]);
	});
}

function deleteMarker(marker) {
	marker.setMap(null); 
}

function addMarker(marker){
	markers = [];
    markers.push(marker);
}