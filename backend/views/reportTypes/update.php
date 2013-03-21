<?php
$this->breadcrumbs=array(
	'Report Types'=>array('index'),
	$model->report_type_id=>array('view','id'=>$model->report_type_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Create ReportTypes','url'=>array('create')),
	array('label'=>'View ReportTypes','url'=>array('view','id'=>$model->report_type_id)),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h1>Cập nhật ReportTypes <?php echo $model->report_type_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>