<?php
$this->breadcrumbs=array(
	'Reports'=>array('index'),
	'Quản lý',
);

$this->menu=array(
	array('label'=>'List Reports','url'=>array('index')),
	array('label'=>'Create Reports','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reports-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Quản lý Báo cáo</h1>

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
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'htmlOptions' => array('class' => 'grid-view rounded'),
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'columns'=>array(
		'report_id',
		array(
			'name' => 'thread_id',
			'value'=>'$data->thread',
		),
		array(
			'name' => 'user_id',
			'value'=>'$data->user',
		),
		array(
			'name' => 'report_type_id',
			'value'=>'$data->reportType',
			'filter' => CHtml::listData(ReportTypes::model()->findAll(), 'report_type_id', 'report_type'),
		),
		'comment',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); ?>
