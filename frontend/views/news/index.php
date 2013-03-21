
<?php
$i = 0;
foreach ($model->findAll() as $value) {
	$criteria = new CDbCriteria;
	$criteria->condition = 'category_id = '.$value->category_id;
	$criteria->order = 'news_id DESC';
	$newest = $model2->find($criteria);?>

<h4>
<?php if (!is_null($newest)) {
	echo $value->category_name ?>
</h4>


	<?php echo CHtml::link($newest->title,array('news/view&id='.$newest->news_id));?>
<br/>
	<?php echo $newest->short_description;?>

	<?php

	$this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$value->getNews($value->category_id),
		'itemView'=>'_index',
		'summaryText'=>false, 
	)); }
	//echo $this->renderPartial('_userview', array('model'=>$value->news,'dataProvider'=>$dataProvider2));
}

?>
