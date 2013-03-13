<?php
$this->breadcrumbs=array(
	'Vườn Quốc Gia'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Liệt kê Vườn Quốc Gia','url'=>array('index')),
	array('label'=>'Tạo mới Vườn Quốc Gia','url'=>array('create')),
	array('label'=>'Cập nhật Vườn Quốc Gia','url'=>array('update','id'=>$model->id)),
	array('label'=>'Xóa Vườn Quốc Gia','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Quản lý Vườn Quốc Gia','url'=>array('admin')),
);
?>

<h1>Xem Vườn Quốc Gia <?php echo $model->park_name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'park_name',
		CHtml::decode('park_description'),
		'longitude',
		'latitude',
	),
)); ?>
