<?php
$this->breadcrumbs=array(
	'Bo',
);

$this->menu=array(
	array('label'=>'Create Bo','url'=>array('create')),
	array('label'=>'Manage Bo','url'=>array('admin')),
);
?>

<h3>Bộ</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
