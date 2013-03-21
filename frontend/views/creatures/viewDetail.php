<h1>Xem Sinh Vật #<?php echo $model->Viet; ?></h1>

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
		'Img',
		'Author',
		'AuthorName',
	),
)); ?>