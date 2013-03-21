<?php
$this->breadcrumbs=array(
	'Nhom'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h1>Tạo mới Nhóm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>