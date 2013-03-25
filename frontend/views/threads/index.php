<?php
$this->breadcrumbs=array(
	'Threads',
);

$this->menu=array(
	array('label'=>'Create Threads','url'=>array('create')),
	array('label'=>'Manage Threads','url'=>array('admin')),
);
?>

<h1>Threads</h1>

<?php $this->widget('zii.widgets.CListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_index',
)); ?>

