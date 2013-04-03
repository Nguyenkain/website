<?php
$this->breadcrumbs=array(
	'Bài viết'=>array('admin'),
	'Thông tin',
);

$this->menu=array(
	array('label'=>'List Posts','url'=>array('index')),
	array('label'=>'Create Posts','url'=>array('create')),
	array('label'=>'Update Posts','url'=>array('update','id'=>$model->post_id)),
	array('label'=>'Delete Posts','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posts','url'=>array('admin')),
);
?>

<h3>Thông tin bài viết</h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
		array(
			'name' => 'Chủ đề',
			'header' => 'Chủ đề',
			'value' => $model->threads,
        ),
		array(
			'name' => 'Người viết',
			'header' => 'Người viết',
			'value' => $model->users->name,
        ),
		'post_content',
        array('name'=>'post_created_time',
        'value'=>date("d/m/y H:i:s", $model->post_created_time)),
	),
)); ?>
