<?php
$this->breadcrumbs=array(
	'Authors'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Author','url'=>array('index')),
	array('label'=>'Manage Author','url'=>array('admin')),
);
?>

<h1>Tạo mới tác giả</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>