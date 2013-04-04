<?php
$this->breadcrumbs=array(
	'Địa điểm phân bố'=>array('admin'),
	$model->province_name=>array('view','id'=>$model->province_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Coordinations','url'=>array('index')),
	array('label'=>'Create Coordinations','url'=>array('create')),
	array('label'=>'View Coordinations','url'=>array('view','id'=>$model->province_id)),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h3>Cập nhật địa điểm phân bố <?php echo $model->province_name; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>