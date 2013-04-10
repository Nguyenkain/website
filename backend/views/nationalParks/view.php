<?php 	$this->breadcrumbs = array(
		'Vườn Quốc Gia' => array('admin'),
		$model->park_name,
		);

	$this->menu = array(
		array('label' => 'Liệt kê Vườn Quốc Gia', 'url' => array('index')),
		array('label' => 'Tạo mới Vườn Quốc Gia', 'url' => array('create')),
		array('label' => 'Cập nhật Vườn Quốc Gia', 'url' => array('update', 'id' => $model->
					id)),
		array(
			'label' => 'Xóa Vườn Quốc Gia',
			'url' => '#',
			'linkOptions' => array('submit' => array('delete', 'id' => $model->id),
					'confirm' => 'Are you sure you want to delete this item?')),
		array('label' => 'Quản lý Vườn Quốc Gia', 'url' => array('admin')),
		); ?>

<h3>Thông tin Vườn Quốc Gia <?php echo $model->park_name; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		'data' => $model,
		'attributes' => array(
			'park_name',
			array(
				'label' => $model->getAttributeLabel('park_description'),
				'type' => 'raw',
				'value' => $model->park_description,
				),
			),
		)); ?>
		
<body>
	<div class="map_form">
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
						park_name, 'icon' => $icon));
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
			$gMap->addEvent(new EGMapEvent('zoom_changed',
					'document.getElementById("zoom_level").innerHTML = map.getZoom();'));
			$gMap->appendMapTo('#map_canvas');
			$gMap->renderMap(array(
					'geocoder = new google.maps.Geocoder();',
					)); ?>
		</div>
	</div>
</body>
