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

<h1>Tạo mới Danh Mục</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>