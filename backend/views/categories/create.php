<?php
$this->breadcrumbs=array(
	'Danh mục'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Categories','url'=>array('index')),
	array('label'=>'Manage Categories','url'=>array('admin')),
);
?>

<h3>Tạo mới Danh Mục</h3>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>