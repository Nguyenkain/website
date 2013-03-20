<?php
$this->breadcrumbs=array(
		'Tin tức'=>array('admin'),
		$model->title,
);

$this->menu=array(
		array('label'=>'List News','url'=>array('index')),
		array('label'=>'Create News','url'=>array('create')),
		array('label'=>'Update News','url'=>array('update','id'=>$model->news_id)),
		array('label'=>'Delete News','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->news_id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage News','url'=>array('admin')),
);
?>

<h1>
	Xem tin
	<?php echo $model->title; ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			'news_id',
			'category_id',
			'short_description',
			array( 
				'label'=>'Nội dung',
				'type'=>'raw',
				'value'=>$model->news_content,
			),
			array(
			'name'=>'created_time',
        	'value'=>date("d/m/y", $model->created_time)),
			'title',
			'image',
		),
)); ?>
