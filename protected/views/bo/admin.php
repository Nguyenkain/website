<?php
$this->breadcrumbs=array(
	'Bo'=>array('index'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List Bo','url'=>array('index')),
	array('label'=>'Create Bo','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý Bộ</h1>

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
	'id'=>'bo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'Viet',
		'LaTin',
		'Nhom',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
