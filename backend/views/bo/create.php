<?php
$this->breadcrumbs=array(
	'Bộ'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h3>Tạo mới Bộ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>