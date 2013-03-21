<?php
$this->breadcrumbs=array(
	'Vườn Quốc Gia',
);

$this->menu=array(
	array('label'=>'Tạo mới Vườn Quốc Gia','url'=>array('create')),
	array('label'=>'Quản lý Vườn Quốc Gia','url'=>array('admin')),
);
?>

<h1>Vườn Quốc Gia</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

