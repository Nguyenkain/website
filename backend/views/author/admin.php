<?php
$this->breadcrumbs=array(
	'Tác giả'=>array('admin'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List Author','url'=>array('index')),
	array('label'=>'Create Author','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('author-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Quản lý tác giả</h3>

<p>
Có thể nhập các phép so sánh (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
hoặc <b>=</b>) trước mỗi giá trị tìm kiếm để tăng độ chính xác của kết quả tìm kiếm.
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'author-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'htmlOptions' => array('class' => 'grid-view rounded'),
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
		
		'Name',
		'Address',
		'Telephone',
		'Email',
		
		'Web',
		'Description',
		
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
