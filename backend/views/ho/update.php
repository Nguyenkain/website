<?php
$this->breadcrumbs=array(
	'Ho'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Ho','url'=>array('index')),
	array('label'=>'Create Ho','url'=>array('create')),
	array('label'=>'View Ho','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Ho','url'=>array('admin')),
);
?>

<h1>Cập nhật Họ <?php echo $model->Viet; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>