<?php
$this->breadcrumbs=array(
	'Bộ'=>array('admin'),
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

<h3>Quản lý Bộ</h3>


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
