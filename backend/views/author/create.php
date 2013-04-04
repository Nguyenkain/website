<?php
$this->breadcrumbs=array(
	'Tác giả'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Author','url'=>array('index')),
	array('label'=>'Manage Author','url'=>array('admin')),
);
?>

<h3>Tạo mới tác giả</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>