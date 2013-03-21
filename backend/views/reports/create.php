<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Reports','url'=>array('index')),
	array('label'=>'Manage Reports','url'=>array('admin')),
);
?>

<h1>Tạo mới Reports</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>