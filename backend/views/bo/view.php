<?php
$this->breadcrumbs=array(
	'Bo'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Create Bo','url'=>array('create')),
	array('label'=>'Update Bo','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Bo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h1>Xem thông tin của Bộ <?php echo $model->Viet; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Viet',
		'LaTin',
		'rNhom',
	),
)); ?>
