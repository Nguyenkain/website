<?php
$this->breadcrumbs=array(
	'Creatures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Creatures','url'=>array('index')),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h1>Tạo sinh vật mới</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>