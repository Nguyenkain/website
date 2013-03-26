<?php
$this->breadcrumbs=array(
	'Nhom',
);

$this->menu=array(
	array('label'=>'Create Nhom','url'=>array('create')),
	array('label'=>'Manage Nhom','url'=>array('admin')),
);
?>

<h1>Nhóm</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
