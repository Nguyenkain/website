<?php
$this->breadcrumbs=array(
	'Tác giả'=>array('admin'),
	$model->Name=>array('view','id'=>$model->ID),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Author','url'=>array('index')),
	array('label'=>'Create Author','url'=>array('create')),
	array('label'=>'View Author','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Author','url'=>array('admin')),
);
?>

<h3>Cập nhật tác giả <?php echo $model->Name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>