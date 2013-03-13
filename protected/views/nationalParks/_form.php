<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'national-parks-form',
		'enableAjaxValidation' => false,
		)); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'park_name', array('class' => 'span5',
		'maxlength' => 255)); ?>
<div class="tinymce">
<?php echo $form->labelEx($model, 'park_description'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce', array(
		'model' => $model,
		'attribute' => 'park_description',
		'editorTemplate' => 'full',
		'htmlOptions' => array(
			'rows' => 6,
			'cols' => 50,
			'class' => 'tinymce'),
		)); ?>
	<?php echo $form->error($model, 'news_content'); ?>
</div>

<style>
  div#map {
    position: relative;
  }
  div#crosshair {
    position: absolute;
/*
     the top will be half of the width of the map
     less 50% of its size more or less
     to center the image correctly on the map
*/
    top: 192px;
    height: 19px;
    width: 19px;
    left: 50%;
    margin-left: -8px;
    display: block;
/* we are going to borrow a crosshair gif from google */
    background: url(http://gmaps-samples-v3.googlecode.com/svn/trunk/geocoder/crosshair.gif);
    background-position: center center;
    background-repeat: no-repeat;
}
</style>

<script type="text/javascript">
  //
  // function to get the latitude and longitude
  // and place them on the test fields
  function setLatLngToClass(){
    if(document.getElementById('NationalParks_latitude'))
        document.getElementById('NationalParks_latitude').value = map.getCenter().lat();
    if(document.getElementById('NationalParks_longitude'))
        document.getElementById('NationalParks_longitude').value = map.getCenter().lng();
  }
  //
  // function to get Centered Latitude and Longitude points
  function getCenterLatLngText() {
    return '(' + map.getCenter().lng() +', '+ map.getCenter().lat() +')';
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
    geocoder.geocode({latLng:map.getCenter()},reverseGeocodeResult);
  }
  //
  // Displays collected reverse geocoded results
  // and displays them on document elements
  function reverseGeocodeResult(results, status) {
    currentReverseGeocodeResponse = results;
    if(status == 'OK') {
      if(results.length == 0) {
        document.getElementById('formatedAddress').innerHTML = 'None';
      } else {
        document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
      }
    } else {
      document.getElementById('formatedAddress').innerHTML = 'Error';
    }
  }
  //
  // geocodes the address inserted
  function geocode() {
    var address = document.getElementById("address").value;
    geocoder.geocode({
      'address': address,
      'partialmatch': true}, geocodeResult);
  }
  function geocodeResult(results, status) {
    if (status == 'OK' && results.length > 0) {
      map.fitBounds(results[0].geometry.viewport);
    } else {
      alert("Không tìm thấy địa điểm này: " + result);
    }
  }
  
</script>

<body style="background:white">
<div class="form">
<div id="address_search">  
 Tìm địa điểm trên bản đồ:
 <input type="text" id="address" style="width:300px"/>
 <button type="button" class="small"onclick="geocode()">Tìm kiếm</button>
  <ul>
     <li>Kinh độ/Vĩ độ:&nbsp;<span id="latlng"></span></li>
     <li>Địa điểm:&nbsp;<span id="formatedAddress"></span></li>
 </ul>
</div>
<div id="map">
    <div id="map_canvas" style="width:100%; height:400px"></div>
    <div id="crosshair"></div>
</div>
<div style="overflow:hidden;width:100%;text-align:right">
<button type="button" class="small" onclick="setLatLngToClass()">Lấy giá trị kinh độ, vĩ độ</button>
</div>
</body>


	<?php Yii::import('ext.EGMap.*');
	// center the map
	// wherever you want
	$latitude = 21.028797427164005;
	$longitude = 105.85235420000004;
	$gMap = new EGMap();
	$gMap->setJsName('map');
	$gMap->width = '100%';
	$gMap->height = '400';
	$gMap->setCenter($latitude, $longitude);
	$gMap->zoom = 6;
	$gMap->addGlobalVariable('geocoder');
	$gMap->addGlobalVariable('centerChangedLast');
	$gMap->addGlobalVariable('reverseGeocodedLast');
	$gMap->addGlobalVariable('currentReversGeocodeResponse');
	$gMap->addEvent(new EGMapEvent('zoom_changed',
		'document.getElementById("zoom_level").innerHTML = map.getZoom();'));
	$gMap->addEvent(new EGMapEvent('center_changed', 'centerChanged', false));
	$gEvent = new EGMapEvent('dblclick', 'map.setZoom(map.getZoom() +1)');
	$gMap->appendMapTo('#map_canvas');
	$gMap->renderMap(array(
		'geocoder = new google.maps.Geocoder();',
		$gEvent->getDomEventJs('crosshair'),
		'reverseGeocodedLast= new Date();',
		'centerChagedLast = new Date();',
		'setInterval(function(){
        if((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
        if(reverseGeocodedLast.getTime() < centerChangedLast.getTime())
          reverseGeocode();
      }
    },1000);',
		'centerChanged();')); ?>
    
    
	<?php echo $form->textFieldRow($model, 'longitude', array('class' => 'span5')); ?>
	<?php echo $form->textFieldRow($model, 'latitude', array('class' => 'span5')); ?>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => $model->isNewRecord ? 'Lưu mới' : 'Lưu',
		)); ?>
</div>
<?php $this->endWidget(); ?>
