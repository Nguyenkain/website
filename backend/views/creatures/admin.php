<?php
$this->breadcrumbs=array(
	
	'Sinh vật'=>array('admin'),
	'Quản lý',
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
		
		/* 'filter' => CHtml::ActiveDropDownList($model, 'Loai', CHtml::listData(Loai::model()->findAll(), 'ID', 'Loai'), array('empty'=>'',
				'id'=>'Loai_Creatures',
				'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),
		

				'url' => CController::createUrl('creatures/dynamicloai'),
				'success' => 'function(data){		
				$("#Nhom_Creatures").html(data.dropdownNhom);
				$("#Bo_Creatures").html(data.dropdownBo);
				$("#Ho_Creatures").html(data.dropdownHo);
				$.fn.yiiGridView.update("creatures-grid");
}',
				)
			)
		), */
		'value'=>'$data->rLoai',
		'htmlOptions'=>array(
		'width'=>'110px',
)),
		
		array(
		'name'=>'Nhom',
		
		/* 'filter' => CHtml::ActiveDropDownList($model, 'Nhom', CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet'), array('empty'=>'',
				'id'=>'Nhom_Creatures',
				'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicnhom'),
				'success' => 'function(data){
				$("#Bo_Creatures").html(data.dropdownBo);
				$("#Ho_Creatures").html(data.dropdownHo);
				$.fn.yiiGridView.update("creatures-grid");

}'	,))), */
		'value'=>'$data->rNhom',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		array(
		'name'=>'Bo',
		
		/* 'filter' => CHtml::ActiveDropDownList($model, 'Bo', CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet'), array('empty'=>'',
		'id'=>'Bo_Creatures',
		'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicbo'),
				'success' => 'function(data){
				$("#Ho_Creatures").html(data.dropdownHo);
				$.fn.yiiGridView.update("creatures-grid");

}'))), */
		'value'=>'$data->rBo',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		
array(
		'name' => 'Ho',

		/* 'filter' => CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet'), */
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
