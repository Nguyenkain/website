<?php
$this->breadcrumbs=array(
	'Creatures Provinces Relations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CreaturesProvincesRelation','url'=>array('index')),
	array('label'=>'Create CreaturesProvincesRelation','url'=>array('create')),
	array('label'=>'Update CreaturesProvincesRelation','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CreaturesProvincesRelation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CreaturesProvincesRelation','url'=>array('admin')),
);
?>

<h1>View CreaturesProvincesRelation #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'creature_id',
		'province_id',
	),
)); ?>
