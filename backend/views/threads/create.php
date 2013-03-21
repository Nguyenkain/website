<?php
$this->breadcrumbs=array(
	'Threads'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Threads','url'=>array('index')),
	array('label'=>'Manage Threads','url'=>array('admin')),
);
?>

<h1>Tạo mới Threads</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>