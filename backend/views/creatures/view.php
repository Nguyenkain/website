<?php
$this->breadcrumbs=array(
	'Creatures'=>array('index'),
	$model->Viet,
);

$this->menu=array(
	array('label'=>'List Creatures','url'=>array('index')),
	array('label'=>'Create Creatures','url'=>array('create')),
	array('label'=>'Update Creatures','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Creatures','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h1>Xem Sinh Vật #<?php echo $model->Viet; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Viet',
		'Latin',
		'rLoai',
		'rHo',
		'rBo',
		'rNhom',
		array(
		'label'=>'Mô tả',
		'type'=>'raw',
		'value'=>$model->Description,

),
		'Img',
		'Author',
		'AuthorName',
	),
)); ?>
