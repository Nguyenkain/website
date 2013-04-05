<div class="news_item">
		<a href="<?php echo Yii::app()->createUrl("news/view",array("id"=>$data->news_id))?>"> 
		<?php echo CHtml::image(Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $data->image . ".jpg");?>
		<p>
			<a href="<?php echo Yii::app()->createUrl("news/view",array("id"=>$data->news_id))?>"><?php echo CHtml::encode($data->title); ?></a>
		</p>
		<p><?php echo CHtml::encode($data->short_description); ?></p>
	</div>