<?php
$this->breadcrumbs=array(
		'Sinh vật'=>array('admin'),
		'Tạo mới',
);

$this->menu=array(
		array('label'=>'List Creatures','url'=>array('index')),
		array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h3>Tạo sinh vật mới</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model,'coordinations'=>$coordinations,'photo'=>$photo)); ?>