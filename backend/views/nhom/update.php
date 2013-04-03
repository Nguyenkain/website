<?php
$this->breadcrumbs=array(
	'Nhóm'=>array('admin'),
	$model->Viet=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Create Nhom','url'=>array('create')),
	array('label'=>'View Nhom','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h3>Cập nhật nhóm <?php echo $model->Viet; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>