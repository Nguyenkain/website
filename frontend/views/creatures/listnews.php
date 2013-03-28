<div class="news_item">
	<div class="images">
		<?php echo CHtml::image(Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $data->image . ".jpg");?>
	</div>
	<div class="news_info">
		<a href="index.php?r=news/view&id=<?php echo $data->news_id ?>" class="news_title"><?php echo $data->title; ?></a>
		<p class="news_content"><?php echo $data->short_description; ?></p>
	</div>
	<div class="clearfix"></div>
</div>
