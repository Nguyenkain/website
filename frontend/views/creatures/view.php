<?php
$this->breadcrumbs=array(
	'Creatures'=>array('index'),
	$model->Viet,
);

$this->menu=array(
	array('label'=>'List Creatures','url'=>array('index')),
	array('label'=>'Create Creatures','url'=>array('create')),
	array('label'=>'Update Creatures','url'=>array('update','id'=>$model->ID)),
	array('label'=>'Delete Creatures','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Creatures','url'=>array('admin')),
);
?>

<h1>Xem Sinh Vật #<?php echo $model->Viet; ?></h1>

<?php 
	
	/* $this->widget('ext.JCarousel.JCarousel', array(
    'dataProvider' => $dataProvider,
    'thumbUrl' => 'Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $data->Img . ".jpg"',
    'imageUrl' => 'Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $data->Img . ".jpg"',
    'vertical' =>false,
	'visible'=>5,
	'scroll'=>5,
));  */?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'Viet',
		'Latin',
		'Loai',
		'Ho',
		'Bo',
		'Nhom',
		array(
		'label'=>'Mô tả',
		'type'=>'raw',
		'value'=>$model->Description,

),
			array(
		'label'=>'Ảnh',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->getBaseUrl(true) . "/images/pictures/insect/" . $model->Img . ".jpg" , "Ảnh Minh Họa", array('width' => '200px')),
),
		'Author',
		'AuthorName',
	),
)); ?>
