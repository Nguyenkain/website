<?php
$this->breadcrumbs=array(
	'Coordinations',
);

$this->menu=array(
	array('label'=>'Create Coordinations','url'=>array('create')),
	array('label'=>'Manage Coordinations','url'=>array('admin')),
);
?>

<h1>Coordinations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
