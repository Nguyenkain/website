<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->post_id=>array('view','id'=>$model->post_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Posts','url'=>array('index')),
	array('label'=>'Create Posts','url'=>array('create')),
	array('label'=>'View Posts','url'=>array('view','id'=>$model->post_id)),
	array('label'=>'Manage Posts','url'=>array('admin')),
);
?>

<h1>Cập nhật Posts <?php echo $model->post_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>