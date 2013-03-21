<?php
$this->breadcrumbs=array(
	'Creatures Provinces Relations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List CreaturesProvincesRelation','url'=>array('index')),
	array('label'=>'Create CreaturesProvincesRelation','url'=>array('create')),
	array('label'=>'View CreaturesProvincesRelation','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CreaturesProvincesRelation','url'=>array('admin')),
);
?>

<h1>Cập nhật CreaturesProvincesRelation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>