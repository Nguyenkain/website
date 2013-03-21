

<div class="userview">
        <?php echo CHtml::link($data->title,array('news/view&id='.$data->news_id));?><br/>
</div>
<?php

/* $this->widget('zii.widgets.CListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'__userview', 
	'sortableAttributes'=>array(
		'category_id',
		'category_name',
		'description',
	),
)); */
?>