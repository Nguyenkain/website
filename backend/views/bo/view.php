<?php
$this->breadcrumbs=array(
	'Bộ'=>array('admin'),
	$model->Viet,
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Create Bo','url'=>array('create')),
	array('label'=>'Update Bo','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Bo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h3>Thông tin của bộ <?php echo $model->Viet; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Viet',
		'LaTin',
		'rNhom',
	),
)); ?>
