<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'coordinations-form',
		'enableAjaxValidation'=>false, ));
$baseUrl = Yii::app()->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/egmap_handle.js');
		$js->registerCssFile($baseUrl . '/css/form.css'); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'province_name',array('class'=>'span5','maxlength'=>50)); ?>

<body style="background: white">
	</br>
	<div class="map_form">
		<div id="address_search">
			Tìm địa điểm trên bản đồ: <br>
			<div id="search">
				<input type="text" id="address" />
				<button type="button" class="btn btn-primary" onclick="geocode()">Tìm kiếm</button>
			</div>
			<ul>
				<li>Kinh độ/Vĩ độ:&nbsp;<span id="latlng"></span>
				</li>
				<li>Địa điểm:&nbsp;<span id="formatedAddress"></span>
				</li>
			</ul>
		</div>
		<div id="map">
			<div id="map_canvas"></div>
			<div id="crosshair"></div>
			<?php Yii::import('common.extensions.EGMap.*');
			$gMap = new EGMap();
			$gMap->setJsName('map');

			// Preparing InfoWindow with information about our marker.
			$info_window = new EGMapInfoWindow($model->province_name);

			// Setting up an icon for marker.
			$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/forest.png");
			$icon->setSize(32, 37);
			$icon->setAnchor(16, 16.5);
			$icon->setOrigin(0, 0);

			if ($model->longitude != null && $model->latitude != null)
			{
				$longitude = $model->longitude;
				$latitude = $model->latitude;
				// Add Gmaker
				$marker = new EGMapMarker($latitude, $longitude, array('title' => $model->
						province_name, 'icon' => $icon));
				$marker->addHtmlInfoWindow($info_window);
				$gMap->addMarker($marker);

			} else
			{
				// center the map
				// wherever you want
				$latitude = 21.028797427164005;
				$longitude = 105.85235420000004;
			}

			$gMap->width = '100%';
			$gMap->height = '400';
			$gMap->setCenter($latitude, $longitude);
			$gMap->zoom = 7;
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
		</div>
		<br>
		<div id="get_latlong">
			<button type="button" class="btn btn-primary" onclick="setLatLngToClass()">Lấy
				giá trị kinh độ, vĩ độ</button>
		</div>
	</div>
</body>

<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
</div>

<?php $this->endWidget(); ?>