<?php
$this->breadcrumbs=array(
	'Báo cáo'=>array('admin'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h1>Tạo mới loại báo cáo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>