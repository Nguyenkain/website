<script>
	// global marker counter
	function generateListElement(marker){
	    var ul = document.getElementById('side_container');
	    var li = document.createElement('li');
	    var aSel = document.createElement('a');
	    aSel.href = 'javascript:void(0);';
	    aSel.innerHTML = marker.title;
	    aSel.onclick = function(){ 
		    google.maps.event.trigger(marker, 'click');
		    map.setCenter(marker.getPosition());
		    };
	    li.appendChild(aSel);
	    ul.appendChild(li);
	}
</script>

<div
	id="nationalParks_content" class="page_content">
	<!-- the side menu container -->
	<div id=side_menu>
		<ul id="side_container"></ul>
	</div>
	<!-- display map -->
	<div id="map_form">
		<div id="map_canvas"></div>
		<?php Yii::import('common.extensions.EGMap.*');
		$gMap = new EGMap();
		$gMap->setJsName('map');

		// Setting up an icon for marker.
		$icon = new EGMapMarkerImage("http://".$_SERVER['HTTP_HOST'].Yii::app()->baseUrl."/images/forest.png");
		$icon->setSize(32, 37);
		$icon->setAnchor(16, 16.5);
		$icon->setOrigin(0, 0);

		// Add marker
		$afterInit = array();
		
		foreach ($model->findAll() as $place){
			$long = $place->longitude;
			$lat = $place->latitude;
			// Add Gmaker
			$marker = new EGMapMarker($lat, $long, array('title' => 'Vườn quốc gia ' .$place->
					park_name, 'icon' => $icon));
			$detail = Yii::app()->baseUrl ."/index.php?r=nationalParks/view&id=" .$place->id;
			$info_window = new EGMapInfoWindow('<div class="info_window"> Vườn quốc gia ' .$place->park_name  .'<a href="' .$detail .'">    xem chi tiết</a></div>');
			$info_window->pixelOffset = new EGMapSize('0','-140');
			$info_window->maxWidth = '50';
			$marker->addHtmlInfoWindow($info_window);
			$gMap->addMarker($marker);
			//Build side-menu
			$afterInit[] = 'generateListElement('.$marker->getJsName().');'.PHP_EOL;
		}

		// center the map
		// wherever you want
		$latitude = 21.028797427164005;
		$longitude = 105.85235420000004;

		$gMap->width = '100%';
		$gMap->height = '100%';
		$gMap->mapTypeId = EGMap::TYPE_HYBRID;
		$gMap->setCenter($latitude, $longitude);
		$gMap->zoom = 7;
		$gMap->appendMapTo('#map_canvas');	
		$gMap->renderMap($afterInit);
		?>
	</div>
	<div class="clearfix"></div>
</div>
