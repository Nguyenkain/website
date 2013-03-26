<?php
$this->breadcrumbs=array(
	'Ho'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Ho','url'=>array('index')),
	array('label'=>'Create Ho','url'=>array('create')),
	array('label'=>'Update Ho','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Ho','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ho','url'=>array('admin')),
);
?>

<h1>Xem Họ #<?php echo $model->ID; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Viet',
		'LaTin',
		'rBo',
	),
)); ?>
