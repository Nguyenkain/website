<?php
$this->breadcrumbs=array(
	'Report Types',
);

$this->menu=array(
	array('label'=>'Create ReportTypes','url'=>array('create')),
	array('label'=>'Manage ReportTypes','url'=>array('admin')),
);
?>

<h1>Report Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
