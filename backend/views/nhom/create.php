<?php
$this->breadcrumbs=array(
	'Nhóm'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h3>Tạo mới Nhóm</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>