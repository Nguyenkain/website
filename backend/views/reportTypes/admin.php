<?php
$this->breadcrumbs=array(
	'Báo cáo'=>array('admin'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List ReportTypes','url'=>array('index')),
	array('label'=>'Create ReportTypes','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('report-types-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Quản lý loại báo cáo</h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'report-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
		'report_type',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array(
					'view'=>array(
							'label'=>'Xem',
					),
					'update'=>array(
							'label'=>'Cập nhật',
					),
					'delete'=>array(
							'label'=>'Xóa',
					),
			),
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); ?>
