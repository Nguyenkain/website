<?php
$this->breadcrumbs=array(
	'Danh mục'=>array('admin'),
	$model->category_name=>array('view','id'=>$model->category_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Categories','url'=>array('index')),
	array('label'=>'Create Categories','url'=>array('create')),
	array('label'=>'View Categories','url'=>array('view','id'=>$model->category_id)),
	array('label'=>'Manage Categories','url'=>array('admin')),
);
?>

<h3>Cập nhật danh mục <?php echo $model->category_name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>