<?php
$this->breadcrumbs=array(
	'Creatures Provinces Relations',
);

$this->menu=array(
	array('label'=>'Create CreaturesProvincesRelation','url'=>array('create')),
	array('label'=>'Manage CreaturesProvincesRelation','url'=>array('admin')),
);
?>

<h1>Creatures Provinces Relations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
