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

<h3>Quản lý Nhóm</h3>

<p>
Có thể nhập các phép so sánh (<, <=, >, >=, <> hoặc =) trước mỗi giá trị tìm kiếm để tăng độ chính
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'nhom-grid',
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
					
		'name'=>'Loai',
		'value'=>'$data->rLoai',
		'filter' => CHtml::listData(Loai::model()->findAll(), 'ID', 'Loai'),
),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
