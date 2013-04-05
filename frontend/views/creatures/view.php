<script type="text/javascript">
		function genmap(){ 
		   setTimeout( function() {
		          google.maps.event.trigger( $('#map_canvas'), 'resize'); }, 1000
		           );
		       }
</script>

<?php 
function checkUrl($url) {
	@$headers = get_headers($url);
	if (preg_match('/^HTTP\/\d\.\d\s+(200|301|302)/', $headers[0])){
		return true;
	}
	else return false;
}?>

<?php

function getImageUrl($loai,$img){
	if($loai==1)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/animal/" . $img . ".jpg";

	if($loai==2)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/plant/" . $img . ".jpg";
	if($loai==3)
		return Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $img . ".jpg";
}
?>

<div id="list-creature" class="page_content">
	<div class="search_container">
		<?php $this->renderPartial('_search',array(
				'model'=>$model,
				'listNhom'=>$listNhom,
				'listBo' => $listBo,
				'listHo' => $listHo,
		));
		?>
	</div>
	<!-- search-form -->
	<div id="creature_content">

		<div class="big_images">
			<a href="<?php echo getImageUrl($model->Loai, $model->Img)?>"> <?php 
			$imageUrl = getImageUrl($model->Loai, $model->Img.'s');
			if(checkUrl($imageUrl))
				echo CHtml::image($imageUrl,"Ảnh con vật");
			else
				echo CHtml::image(getImageUrl($model->Loai, $model->Img),"Ảnh con vật");
			?>
			</a>
		</div>

		<div class="creature_info">

			<div class="creature_name">
				<div class="name_item">
					<div class="name">Tên Việt Nam:</div>
					<div class="vn_name">
						<?php echo $model->Viet?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Tên Latin:</div>
					<div class="latin_name">
						<?php echo $model->Latin?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Họ:</div>
					<div class="normal_name">
						<?php echo $model->rHo?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Bộ:</div>
					<div class="normal_name">
						<?php echo $model->rBo?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="name_item">
					<div class="name">Lớp (nhóm):</div>
					<div class="normal_name">
						<?php echo $model->rNhom?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="small_images">
				<?php for ($i = 1; $i <= 4; $i++) {
					$img_url = getImageUrl($model->Loai, $model->Img.'_'.$i.'s');
					if(checkUrl($img_url)) {
						?>
				<a href="<?php echo $img_url?>"><?php echo CHtml::image($img_url);?>
				</a>
				<?php }
				}?>
				<div class="clearfix"></div>
			</div>

		</div>

		<div id="creature_mini_map">
			<!-- display map -->
			<div id="mini_canvas"></div>
			<?php 
			Yii::import('common.extensions.EGMap.*');
			$gMap = new EGMap();

			// Setting up an icon for marker.
			if($model->Loai==1)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/bird.png");
			if($model->Loai==2)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/forest.png");
			if($model->Loai==3)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/bee.png");

			$icon->setSize(32, 37);
			$icon->setAnchor(16, 16.5);
			$icon->setOrigin(0, 0);

			// Add marker
			$coordinations=$model->rProvince;
			foreach ($coordinations as $place){
				$long = $place->longitude;
				$lat = $place->latitude;
				// Add Gmaker
				$marker = new EGMapMarker($lat, $long, array('title' => $place->province_name, 'icon' => $icon));
				$gMap->addMarker($marker);
			}

			// center the map
			// wherever you want
			$latitude = 16.043609024612344;
			$longitude = 105.80669254999998;

			$gMap->width = '200';
			$gMap->height = '200';
			$gMap->setCenter($latitude, $longitude);
			$gMap->zoom = 4;
			$gMap->mapTypeId = EGMap::TYPE_HYBRID;
			$gMap->disableDefaultUI = 'true';
			$gMap->appendMapTo('#mini_canvas');
			$gMap->renderMap();
			?>
			<button id="view_map_large" href="#map_canvas">Xem bản đồ phân bố lớn</button>
		</div>

		<div class="clearfix"></div>

		<div class="creature_content">

			<?php echo $model->Description?>
			<div class="clearfix"></div>
		</div>

		<div id="creature_map">
			<!-- display map -->
			<div id="map_canvas"></div>
			<?php 
			Yii::import('common.extensions.EGMap.*');
			$gMap = new EGMap();

			// Setting up an icon for marker.
			if($model->Loai==1)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/bird.png");
			if($model->Loai==2)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/forest.png");
			if($model->Loai==3)
				$icon = new EGMapMarkerImage(Yii::app()->baseUrl."/images/bee.png");

			$icon->setSize(32, 37);
			$icon->setAnchor(16, 16.5);
			$icon->setOrigin(0, 0);

			// Add marker
			$coordinations=$model->rProvince;
			foreach ($coordinations as $place){
				$long = $place->longitude;
				$lat = $place->latitude;
				// Add Gmaker
				$marker = new EGMapMarker($lat, $long, array('title' => $place->province_name, 'icon' => $icon));
				$info_window = new EGMapInfoWindow('<div class="info_window">' .$place->province_name . '</div>');
				$marker->addHtmlInfoWindow($info_window);
				$gMap->addMarker($marker);
			}

			// center the map
			// wherever you want
			$latitude = 16.043609024612344;
			$longitude = 105.80669254999998;

			$gMap->width = '450';
			$gMap->height = '600';
			$gMap->mapTypeId = EGMap::TYPE_HYBRID;
			$gMap->setCenter($latitude, $longitude);
			$gMap->zoom = 6;
			$gMap->appendMapTo('#map_canvas');
			$gMap->renderMap();

			//put fancybox on page
			$this->widget('application.extensions.fancybox.EFancyBox', array(
					'target'=>'#view_map_large',
					'config'=>array(),
			));
			?>
		</div>
	</div>
</div>

<div id="footer" class="normal">
	<div class="footer-info">
		<?php $this->widget('ext.carouFredSel.ECarouFredSel', array(
				'id' => 'carousel',
				'target' => '#foo',
				'config' => array(
						'responsive' => true,
						'items' => 5,
						'scroll' => array(
								'items' => 1,
								'easing' => 'quadratic',
								'duration' => 800,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
						),
						'sweep' => array(
								'items' => 1,
								'easing' => 'quadratic',
								'duration' => 800,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
								'onMouse'=>true,
						),
				),
		));
		?>

		<h5>Sinh vật liên quan</h5>
		<div id="foo">
			<?php 
			$creature = Creatures::model()->findAllByAttributes(array("Bo" => $model->Bo));
			foreach ($creature as $item) {
			$data = $item;
			?>
			<div class="item">

				<a
					href="<?php echo Yii::app()->createUrl("creatures/view",array("id" => $data->ID));?>">
					<img alt="Ảnh con vật"
					src="<?php echo getImageUrl($data->Loai,$data->Img)?>">
					<h6>
						<?php echo $data->Viet?>
					</h6>
				</a>

			</div>
			<?php }?>

		</div>
	</div>

	<div id="copyright">
		<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam'
			khi bạn phát hành lại thông tin từ Website này</p>
	</div>
</div>


<?php 

// import the extension
Yii::import('ext.jqPrettyPhoto');

$options = array(
		'slideshow'=>5000,
		'autoplay_slideshow'=>false,
		'show_title'=>false,
		'default_width' => 500,
		'allow_resize' => true,
);
// call addPretty static function
jqPrettyPhoto::addPretty('#creature_content a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);

?>