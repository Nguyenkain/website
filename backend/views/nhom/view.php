<?php
$this->breadcrumbs=array(
	'Nhóm'=>array('admin'),
	$model->Viet,
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Create Nhom','url'=>array('create')),
	array('label'=>'Update Nhom','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Nhom','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h3>Thông tin của nhóm <?php echo $model->Viet; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Viet',
		'LaTin',
		'rLoai',
		'icon',
	),
)); ?>
