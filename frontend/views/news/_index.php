

<div class="news_link">
	<?php echo CHtml::image(Yii::app()->request->getBaseUrl(true) . "/css/images/list_indicator.png");?>
	<?php echo CHtml::link($data->title,array('news/view&id='.$data->news_id));?>
</div>
