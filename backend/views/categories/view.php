<?php
$this->breadcrumbs=array(
	'Danh mục'=>array('admin'),
	$model->category_name,
);

$this->menu=array(
	array('label'=>'List Categories','url'=>array('index')),
	array('label'=>'Create Categories','url'=>array('create')),
	array('label'=>'Update Categories','url'=>array('update','id'=>$model->category_id)),
	array('label'=>'Delete Categories','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->category_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categories','url'=>array('admin')),
);
?>

<h3>Xem danh mục <?php echo $model->category_name; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'category_id',
		'category_name',
		'description',
	),
)); ?>
