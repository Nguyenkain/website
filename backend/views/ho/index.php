<?php
$this->breadcrumbs=array(
	'Họ',
);

$this->menu=array(
	array('label'=>'Create Ho','url'=>array('create')),
	array('label'=>'Manage Ho','url'=>array('admin')),
);
?>

<h3>Họ</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
