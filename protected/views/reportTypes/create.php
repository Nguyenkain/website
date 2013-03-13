<?php
$this->breadcrumbs=array(
	'Report Types'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h1>Tạo mới ReportTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>