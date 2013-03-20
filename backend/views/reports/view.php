<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->report_id,
);

$this->menu=array(
	array('label'=>'List Reports','url'=>array('index')),
	array('label'=>'Create Reports','url'=>array('create')),
	array('label'=>'Update Reports','url'=>array('update','id'=>$model->report_id)),
	array('label'=>'Delete Reports','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->report_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reports','url'=>array('admin')),
);
?>

<h1>View Reports #<?php echo $model->report_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'report_id',
		'thread_id',
		'user_id',
		'report_type_id',
		'comment',
	),
)); ?>
