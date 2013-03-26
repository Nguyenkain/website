<?php
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
<div class="search-form" style="display:true">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<!-- search-form -->
<?php 


	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'creatures-grid',
	'dataProvider'=>$dataProvider,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
			array(
					'class' => 'bootstrap.widgets.TbImageColumn',
					'header' => 'Ảnh',
					'imagePathExpression' => 'Yii::app()->request->getBaseUrl(true) . "/images/images" . $data->Img . ".jpg"',
					'htmlOptions' => array('width'=>'60px'),
			),
			
			array(
	'name'=>'Viet',
	'header'=>'Tên Việt/Tên Latin',
	'value'=>'$data->Viet."/".$data->Latin',

),
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
