<?php
$this->breadcrumbs=array(
	'Authors'=>array('index'),
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

<h1>Cập nhật Author <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>