<?php $this->breadcrumbs = array(
		'Vườn Quốc Gia' => array('admin'),
		'Quản lý',
		);

	$this->menu = array(
		array('label' => 'Liệt kê Vườn Quốc Gia', 'url' => array('index')),
		array('label' => 'Tạo mới Vườn Quốc Gia', 'url' => array('create')),
		);

	Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('national-parks-grid', {
		data: $(this).serialize()
	});
	return false;
});
"); ?>

<h3>Quản lý Vườn Quốc Gia</h3>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'national-parks-grid',
		'filter'=>$model,
		'dataProvider' => $model->search(),
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
		'columns' => array(
			array(
				'name' => 'park_name',
				'value' => '$data->park_name',
				'filter' => CHtml::listData(NationalParks::model()->findAll(), 'park_name', 'park_name'),
				'htmlOptions' => array('width' => '400px'),
				),
			array(
					'name' => 'longitude',
					'filter' => false,
			),
			array(
					'name' => 'latitude',
					'filter' => false,
			),
			array('class' => 'bootstrap.widgets.TbButtonColumn',
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
				'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'", ),
			),
		)); ?>
