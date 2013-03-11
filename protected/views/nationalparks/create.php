<?php
$this->breadcrumbs=array(
	'National Parks'=>array('index'),
	'Tạo mới',
);

$this->menu=array(
	array('label'=>'List NationalParks','url'=>array('index')),
	array('label'=>'Manage NationalParks','url'=>array('admin')),
);
?>

<h1>Tạo mới NationalParks</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>