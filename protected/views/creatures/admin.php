<?php
$this->breadcrumbs=array(
	'Creatures'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Creatures','url'=>array('index')),
	array('label'=>'Create Creatures','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('creatures-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Creatures</h1>

<p>
Có thể nhập các phép so sánh (<, <=, >, >=, <> hoặc =) trước mỗi giá trị tìm kiếm để tăng độ chính xác của kết quả tìm kiếm.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'creatures-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'Viet',
		'Latin',
		'Loai',
		'Ho',
		'Bo',
		
		'Nhom',
	/*	'Description',*/
	/*	'Img',        */
	/*	'Author',     */
		'AuthorName',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
