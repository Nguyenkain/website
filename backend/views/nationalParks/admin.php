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

<p>
Có thể nhập các phép so sánh (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
hoặc <b>=</b>) trước mỗi giá trị tìm kiếm để tăng độ chính xác của kết quả tìm kiếm.
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao', '#', array('class' =>
		'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array('model' => $model, )); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'national-parks-grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
		'columns' => array(
			'id',
			array(
				'name' => 'park_name',
				'value' => '$data->park_name',
				'htmlOptions' => array('width' => '140px'),
				),
			array(
				'name' => 'park_description',
				'value' => 'substr($data->park_description, 0, 600)',
				),
			array(
				'name' => 'longitude',
				'htmlOptions' => array('width' => '60px'),
				),
			'latitude',
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
