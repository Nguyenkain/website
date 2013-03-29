<div id="nationalParks_content" class="page_content">
	<div class="map_form">
		<div id="map">
			<div id="map_canvas"></div>
			<?php Yii::import('common.extensions.EGMap.*');
			$gMap = new EGMap();
			$gMap->setJsName('map');

			// Setting up an icon for marker.
			$icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/forest.png");
			$icon->setSize(32, 37);
			$icon->setAnchor(16, 16.5);
			$icon->setOrigin(0, 0);

			// Add marker
			foreach ($model->findAll() as $place){
				$long = $place->longitude;
				$lat = $place->latitude;
				// Add Gmaker
				$marker = new EGMapMarker($lat, $long, array('title' => 'Vườn Quốc Gia ' .$place->
						park_name, 'icon' => $icon));
				$gMap->addMarker($marker);
			}

			// center the map
			// wherever you want
			$latitude = 21.028797427164005;
			$longitude = 105.85235420000004;

			$gMap->width = '100%';
			$gMap->height = '500';
			$gMap->setCenter($latitude, $longitude);
			$gMap->zoom = 7;
			$gMap->appendMapTo('#map_canvas');
			$gMap->renderMap();	?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
