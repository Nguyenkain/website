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

<h3>Tạo mới Họ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>