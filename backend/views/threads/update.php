<?php
$this->breadcrumbs=array(
	'Chủ đề'=>array('admin'),
	$model->thread_title=>array('view','id'=>$model->thread_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Threads','url'=>array('index')),
	array('label'=>'Create Threads','url'=>array('create')),
	array('label'=>'View Threads','url'=>array('view','id'=>$model->thread_id)),
	array('label'=>'Manage Threads','url'=>array('admin')),
);
?>

<h3>Cập nhật chủ đề <?php echo $model->thread_title; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>