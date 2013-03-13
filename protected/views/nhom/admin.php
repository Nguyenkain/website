<?php
$this->breadcrumbs=array(
	'Nhom'=>array('index'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List Nhom','url'=>array('index')),
	array('label'=>'Create Nhom','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('nhom-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý nhóm</h1>

<p>
Có thể nhập các phép so sánh (<, <=, >, >=, <> hoặc =) trước mỗi giá trị tìm kiếm để tăng độ chính
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'nhom-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'Viet',
		'LaTin',
		'Loai',
		'icon',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
