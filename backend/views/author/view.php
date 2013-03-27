<?php
$this->breadcrumbs=array(
	'Authors'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Author','url'=>array('index')),
	array('label'=>'Create Author','url'=>array('create')),
	array('label'=>'Update Author','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Author','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Author','url'=>array('admin')),
);
?>

<h3>Xem tác giả #<?php echo $model->Name; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Name',
		'DOB',
		'Address',
		'Telephone',
		'Email',
		'Web',
		'Description',
	),
)); ?>
