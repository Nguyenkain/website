<?php
$this->breadcrumbs=array(
	'Họ'=>array('index'),
	$model->Viet=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Ho','url'=>array('index')),
	array('label'=>'Create Ho','url'=>array('create')),
	array('label'=>'View Ho','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Ho','url'=>array('admin')),
);
?>

<h3>Cập nhật họ <?php echo $model->Viet; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>