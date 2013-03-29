<?php
$this->breadcrumbs=array(
		'Creatures'=>array('index'),
		$model->ID=>array('view','id'=>$model->ID),
		'Update',
);

$this->menu=array(
		array('label'=>'List Creatures','url'=>array('index')),
		array('label'=>'Create Creatures','url'=>array('create')),
		array('label'=>'View Creatures','url'=>array('view','id'=>$model->ID)),
		array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h3>
	Cập nhật sinh vật :
	<?php echo $model->Viet; ?>
</h3>

<?php echo $this->renderPartial('_formupdate',array('model'=>$model,'coordinations'=>$coordinations)); ?>