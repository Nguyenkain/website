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

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'bo-grid',
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
					
		'name'=>'Nhom',
		'value'=>'$data->rNhom',
		'filter' => CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet'),
		
),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
