<?php
$this->breadcrumbs=array(
	'Authors',
);

$this->menu=array(
	array('label'=>'Create Author','url'=>array('create')),
	array('label'=>'Manage Author','url'=>array('admin')),
);
?>

<h3>Tác giả</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
