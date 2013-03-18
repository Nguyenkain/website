<?php
$this->breadcrumbs=array(
	'Coordinations'=>array('index'),
	$model->province_id,
);

$this->menu=array(
	array('label'=>'List Coordinations','url'=>array('index')),
	array('label'=>'Create Coordinations','url'=>array('create')),
	array('label'=>'Update Coordinations','url'=>array('update','id'=>$model->province_id)),
	array('label'=>'Delete Coordinations','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->province_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h1>View Coordinations #<?php echo $model->province_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'province_id',
		'province_name',
		'longitude',
		'latitude',
	),
)); ?>
