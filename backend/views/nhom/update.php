<?php
$this->breadcrumbs=array(
	'Nhoms'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Create Nhom','url'=>array('create')),
	array('label'=>'View Nhom','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h1>Cập nhật Nhóm <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>