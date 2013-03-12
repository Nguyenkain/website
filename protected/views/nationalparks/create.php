<?php
$this->breadcrumbs=array(
	'Vườn Quốc Gia'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'Liệt kê Vườn Quốc Gia','url'=>array('index')),
	array('label'=>'Tạo mới Vườn Quốc Gia','url'=>array('admin')),
);
?>

<h1>Tạo mới Vườn Quốc Gia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>