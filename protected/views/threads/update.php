<?php
$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->thread_id=>array('view','id'=>$model->thread_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Threads','url'=>array('index')),
	array('label'=>'Create Threads','url'=>array('create')),
	array('label'=>'View Threads','url'=>array('view','id'=>$model->thread_id)),
	array('label'=>'Manage Threads','url'=>array('admin')),
);
?>

<h1>Cập nhật Threads <?php echo $model->thread_title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>