<?php
$this->breadcrumbs=array(
	'Địa điểm phân bố'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Coordinations','url'=>array('index')),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h3>Tạo mới địa điểm phân bố</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>