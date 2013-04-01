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
		));
		?>
	</div>
	<!-- search-form -->
	<div id="creature_content">

		<div class="big_images">
			<a href="<?php echo getImageUrl($model->Loai, $model->Img)?>"> <?php echo CHtml::image(getImageUrl($model->Loai, $model->Img),"Ảnh con vật")?>
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
					$img_url = getImageUrl($model->Loai, $model->Img.'_'.$i);
					if(checkUrl($img_url)) {
				?>
				<a href="<?php echo $img_url?>"><?php echo CHtml::image($img_url);?>
				</a>
				<?php }
				}?>
				<div class="clearfix"></div>
			</div>

		</div>

		<div class="clearfix"></div>

		<div class="creature_content">

			<?php echo $model->Description?>

		</div>



	</div>
	<?php 


	?>
</div>


<div id="footer" class="normal">
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