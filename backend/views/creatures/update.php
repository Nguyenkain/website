<?php
$this->breadcrumbs=array(
	'Creatures'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Creatures','url'=>array('index')),
	array('label'=>'Create Creatures','url'=>array('create')),
	array('label'=>'View Creatures','url'=>array('view','id'=>$model->ID)),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h1>Update Creatures <?php echo $model->Viet; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'coordinations'=>$coordinations)); ?>