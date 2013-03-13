<?php
$this->breadcrumbs=array(
	'Bo'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h1>Tạo mới Bộ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>