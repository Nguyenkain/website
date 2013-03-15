<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	$model->report_id=>array('view','id'=>$model->report_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List Reports','url'=>array('index')),
	array('label'=>'Create Reports','url'=>array('create')),
	array('label'=>'View Reports','url'=>array('view','id'=>$model->report_id)),
	array('label'=>'Manage Reports','url'=>array('admin')),
);
?>

<h1>Cập nhật báo cáo</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>