<?php
$this->breadcrumbs=array(
	'Bài viết'=>array('admin'),
	'Thông tin'=>array('view','id'=>$model->post_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Posts','url'=>array('index')),
	array('label'=>'Create Posts','url'=>array('create')),
	array('label'=>'View Posts','url'=>array('view','id'=>$model->post_id)),
	array('label'=>'Manage Posts','url'=>array('admin')),
);
?>

<h3>Cập nhật bài viết</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>