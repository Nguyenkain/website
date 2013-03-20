<?php
$this->breadcrumbs=array(
	'Hos'=>array('index'),
	'Tạo mới họ',
);

$this->menu=array(
	array('label'=>'List Ho','url'=>array('index')),
	array('label'=>'Manage Ho','url'=>array('admin')),
);
?>

<h1>Tạo mới Họ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>