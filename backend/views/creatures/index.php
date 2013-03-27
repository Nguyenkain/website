<?php
$this->breadcrumbs=array(
	'Creatures',
);

$this->menu=array(
	array('label'=>'Create Creatures','url'=>array('create')),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h3>Sinh vật</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
