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

<h3>Quản lý Sinh Vật</h3>

<p>
Có thể nhập các phép so sánh (<, <=, >, >=, <> hoặc =) trước mỗi giá trị tìm kiếm để tăng độ chính xác của kết quả tìm kiếm.
</p>


<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
	
)); ?>
</div>
<!-- search-form -->
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'creatures-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
		'Viet',
		'Latin',
		array(
					
		'name'=>'Loai',
		
		'filter' => CHtml::listData(Loai::model()->findAll(), 'ID', 'Loai'),
		'value'=>'$data->rLoai',
		'htmlOptions'=>array(
		'width'=>'110px',
)),
		
		array(
		'name'=>'Nhom',
		
		'filter' => CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rNhom',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		array(
		'name'=>'Bo',
		
		'filter' => CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rBo',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		
array(
		'name' => 'Ho',
		'header'=>'Họ',
		'filter' => CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rHo',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
	/*	'Description',*/
	/*	'Img',        */
	/*	'Author',     */
	//	'AuthorName',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
),
	),
)); ?>
