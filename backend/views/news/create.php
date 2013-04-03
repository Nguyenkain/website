<?php
$this->breadcrumbs=array(
	'Tin tức'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List News','url'=>array('index')),
	array('label'=>'Manage News','url'=>array('admin')),
);
?>

<h3>Tạo tin mới</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>