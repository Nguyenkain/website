<script type="text/javascript">
	function replaceImages() {
		$('#news_content img').each(function() {
			var link = $(this).attr('src');
			if(link.indexOf("forumpic") != -1) {
				link = "images/" + link;
			}
			$(this).attr('src',link);
		});

		$('p.Heading02').remove();
	}
</script>

<?php Yii::app()->clientScript->registerScript('replace', "replaceImages();");?>

<div id="news_content" class="page_content">

	<h3><?php echo $model->title?></h3>
	
	<div class='hoz_line long'></div>
	
	<?php echo $model->news_content?>

</div>

<div id="footer" class="normal">
	<div class="footer-info">
		<?php $this->widget('ext.carouFredSel.ECarouFredSel', array(
				'id' => 'carousel',
				'target' => '#foo',
				'config' => array(
						'items' => 5,
						'scroll' => array(
								'items' => 1,
								'easing' => 'cubic',
								'duration' => 800,
								'pauseDuration' => 1500,
								'pauseOnHover' => true,
								'fx' => 'directscroll',
						),
				),
		));
		?>
		
		<h5>Tin Liên Quan</h5>
		<div id="foo">
			<?php 
			$news = News::model()->findAllByAttributes(array("category_id" => $model->category_id));
			foreach ($news as $item) {
			$data = $item;
			?>
			<div class="item">
			
			<a href="<?php echo Yii::app()->createUrl("news/view",array("id" => $data->news_id));?>">
				<img alt="Ảnh tin tức" src="<?php echo Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $data->image . ".jpg";?>">
				<h6><?php echo $data->title?></h6>
			</a>
			
			</div>
			<?php }?>

	</div>
</div>
<div id="copyright">
	<p>Copyright &copy; 2003-2013 Ghi rõ nguồn 'Sinh vật rừng Việt Nam' khi
		bạn phát hành lại thông tin từ Website này</p>
</div>
</div>