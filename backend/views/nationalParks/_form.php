<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'national-parks-form',
		'enableAjaxValidation' => false,
));
$baseUrl = Yii::app()->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/egmap_handle.js');
	$js->registerCssFile($baseUrl . '/css/form.css'); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>
<?php echo $form->errorSummary($model,'Vui lòng kiểm tra lại những lỗi sau:'); ?>
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
	<?php echo $form->error($model, 'park_description'); ?>
</div>

<body>
	<div class="map_form">
		<div id="address_search">
			Tìm địa điểm trên bản đồ: <span class="required">*</span><br>
			<div id="search">
				<input type="text" id="address" />
				<button type="button" class="btn btn-primary" onclick="geocode()">Tìm kiếm</button>
			</div>
		</div>
		<div id="map">
			<div id="map_canvas"></div>
			<?php Yii::import('common.extensions.EGMap.*');
			$gMap = new EGMap();
			$gMap->setJsName('map');

			// Preparing InfoWindow with information about our marker.
			$info_window = new EGMapInfoWindow($model->park_name);

			// Setting up an icon for marker.
			$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/forest.png");
			$icon->setSize(32, 37);
			$icon->setAnchor(16, 16.5);
			$icon->setOrigin(0, 0);
			$jsAddMaker = '';
			
			if ($model->longitude != null && $model->latitude != null)
			{
				$longitude = $model->longitude;
				$latitude = $model->latitude;
				// Add Gmaker
				$marker = new EGMapMarker($latitude, $longitude, array('title' => $model->
						park_name, 'icon' => $icon, 'draggable'=>true));
				$marker->addHtmlInfoWindow($info_window);
				$jsAddMaker = 'addMarker('.$marker->getJsName().');';
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
			$gMap->addEvent(new EGMapEvent('zoom_changed',
					'document.getElementById("zoom_level").innerHTML = map.getZoom();'));
			$gMap->appendMapTo('#map_canvas');
			$gMap->renderMap(array(
					'geocoder = new google.maps.Geocoder();',
					$jsAddMaker,
					)); ?>
		</div>
	</div>
</body>

<?php echo $form->textFieldRow($model, 'longitude', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'latitude', array('class' => 'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type' => 'primary',
			'label' => $model->isNewRecord ? 'Tạo mới' : 'Lưu',
			'htmlOptions' => array(
					'onclick' => 'setLatLngToClass();'
			),
		)); ?>
</div>
<?php $this->endWidget(); ?>
