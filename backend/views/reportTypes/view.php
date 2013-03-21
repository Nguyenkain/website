<?php
$this->breadcrumbs=array(
	'Report Types'=>array('index'),
	$model->report_type_id,
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Create ReportTypes','url'=>array('create')),
	array('label'=>'Update ReportTypes','url'=>array('update','id'=>$model->report_type_id)),
	array('label'=>'Delete ReportTypes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->report_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h1>View ReportTypes #<?php echo $model->report_type_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'report_type_id',
		'report_type',
	),
)); ?>
