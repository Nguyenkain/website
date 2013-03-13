// function to get the latitude and longitude
// and place them on the test fields

function setLatLngToClass() {
	if (document.getElementById('NationalParks_latitude')) document.getElementById('NationalParks_latitude').value = map.getCenter().lat();
	if (document.getElementById('NationalParks_longitude')) document.getElementById('NationalParks_longitude').value = map.getCenter().lng();
}
//
// function to get Centered Latitude and Longitude points

function getCenterLatLngText() {
	return '(' + map.getCenter().lng() + ', ' + map.getCenter().lat() + ')';
}
//
// function to call when the center of the map
// has changed. Center information will be
// collected and displayed on the document
// elements

function centerChanged() {
	centerChangedLast = new Date();
	var latlng = getCenterLatLngText();
	document.getElementById('latlng').innerHTML = latlng;
	document.getElementById('formatedAddress').innerHTML = '';
	currentReverseGeocodeResponse = reverseGeocode();
}
//
// Collects reverse center location

function reverseGeocode() {
	reverseGeocodedLast = new Date();
	geocoder.geocode({
		latLng: map.getCenter()
	}, reverseGeocodeResult);
}
//
// Displays collected reverse geocoded results
// and displays them on document elements

function reverseGeocodeResult(results, status) {
	currentReverseGeocodeResponse = results;
	if (status == 'OK') {
		if (results.length == 0) {
			document.getElementById('formatedAddress').innerHTML = 'None';
		} else {
			document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
		}
	} else {
		document.getElementById('formatedAddress').innerHTML = 'Error';
	}
}

// adds marker to the center of the map
  function addMarkerAtCenter() {
    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map
    });
    var text = 'Lat/Lng: ' + getCenterLatLngText();
    if(currentReverseGeocodeResponse) {
      var addr = '';
      if(currentReverseGeocodeResponse.size == 0) {
        addr = 'None';
      } else {
        addr = currentReverseGeocodeResponse[0].formatted_address;
      }
      text = text + '<br>' + 'address: <br>' + addr;
    }
    var infowindow = new google.maps.InfoWindow({ content: text });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
  }
//
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
		map.fitBounds(results[0].geometry.viewport);
	} else {
		alert("Không tìm th?y d?a di?m này: " + result);
	}
}