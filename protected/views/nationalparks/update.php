<?php
$this->breadcrumbs=array(
	'National Parks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List NationalParks','url'=>array('index')),
	array('label'=>'Create NationalParks','url'=>array('create')),
	array('label'=>'View NationalParks','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage NationalParks','url'=>array('admin')),
);
?>

<h1>Cập nhật NationalParks <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>