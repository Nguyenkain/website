<?php
$this->breadcrumbs=array(
	'Họ'=>array('index'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List Ho','url'=>array('index')),
	array('label'=>'Create Ho','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ho-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý Họ</h1>

<p>
Có thể dùng các kí hiệu để tìm kiếm nâng cao
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'ho-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
		
		'Viet',
		'LaTin',
				array(
					
		'name'=>'Bo',
		'value'=>'$data->rBo',
		'filter' => CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet'),
		
),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
