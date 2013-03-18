<?php
$this->breadcrumbs=array(
	'Coordinations'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Coordinations','url'=>array('index')),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h1>Tạo mới Coordinations</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>