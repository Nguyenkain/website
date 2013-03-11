<?php
$this->breadcrumbs=array(
	'National Parks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NationalParks','url'=>array('index')),
	array('label'=>'Create NationalParks','url'=>array('create')),
	array('label'=>'Update NationalParks','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete NationalParks','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NationalParks','url'=>array('admin')),
);
?>

<h1>View NationalParks #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'park_name',
		'park_description',
		'longitude',
		'latitude',
	),
)); ?>
