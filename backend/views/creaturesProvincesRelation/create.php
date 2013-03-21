<?php
$this->breadcrumbs=array(
	'Creatures Provinces Relations'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List CreaturesProvincesRelation','url'=>array('index')),
	array('label'=>'Manage CreaturesProvincesRelation','url'=>array('admin')),
);
?>

<h1>Tạo mới CreaturesProvincesRelation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>