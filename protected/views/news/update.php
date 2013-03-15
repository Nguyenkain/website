<?php
$this->breadcrumbs=array(
	'Tin tức'=>array('admin'),
	$model->title=>array('view','id'=>$model->news_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List News','url'=>array('index')),
	array('label'=>'Create News','url'=>array('create')),
	array('label'=>'View News','url'=>array('view','id'=>$model->news_id)),
	array('label'=>'Manage News','url'=>array('admin')),
);
?>

<h1>Cập nhật tin tức <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>