<?php
$this->breadcrumbs=array(
	'National Parks',
);

$this->menu=array(
	array('label'=>'Create NationalParks','url'=>array('create')),
	array('label'=>'Manage NationalParks','url'=>array('admin')),
);
?>

<h1>National Parks</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
