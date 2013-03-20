<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List Posts','url'=>array('index')),
	array('label'=>'Manage Posts','url'=>array('admin')),
);
?>

<h1>Tạo mới Posts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>