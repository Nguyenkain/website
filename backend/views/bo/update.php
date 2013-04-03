<?php
$this->breadcrumbs=array(
	'Bộ'=>array('admin'),
	$model->Viet=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Create Bo','url'=>array('create')),
	array('label'=>'View Bo','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h3>Cập nhật bộ <?php echo $model->Viet; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>