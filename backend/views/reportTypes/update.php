<?php
$this->breadcrumbs=array(
	'Báo cáo'=>array('admin'),
	$model->report_type=>array('view','id'=>$model->report_type_id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Create ReportTypes','url'=>array('create')),
	array('label'=>'View ReportTypes','url'=>array('view','id'=>$model->report_type_id)),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h3>Cập nhật báo cáo <?php echo $model->report_type; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>