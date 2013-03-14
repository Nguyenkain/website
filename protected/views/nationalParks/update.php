<?php
$this->breadcrumbs=array(
	'Vườn Quốc Gia'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Cập nhật',
);

$this->menu=array(
	array('label'=>'Liệt kê Vườn Quốc Gia','url'=>array('index')),
	array('label'=>'Tạo mới Vườn Quốc Gia','url'=>array('create')),
	array('label'=>'Xem Vườn Quốc Gia','url'=>array('view','id'=>$model->id)),
	array('label'=>'Quản lý Vườn Quốc Gia','url'=>array('admin')),
);
?>

<h1>Cập nhật Vườn Quốc Gia <?php echo $model->park_name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>