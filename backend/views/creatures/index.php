<?php
$this->breadcrumbs=array(
	'Creatures',
);

$this->menu=array(
	array('label'=>'Create Creatures','url'=>array('create')),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h1>Creatures</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
