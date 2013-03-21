<?php
$this->breadcrumbs=array(
	'Coordinations'=>array('index'),
	$model->province_id=>array('view','id'=>$model->province_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Coordinations','url'=>array('index')),
	array('label'=>'Create Coordinations','url'=>array('create')),
	array('label'=>'View Coordinations','url'=>array('view','id'=>$model->province_id)),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h1>Cập nhật Coordinations <?php echo $model->province_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>