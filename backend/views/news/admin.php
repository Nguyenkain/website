<?php
$this->breadcrumbs=array(
		'Tin tức'=>array('admin'),
		'Quản lý',
);

$this->menu=array(
		array('label'=>'List News','url'=>array('index')),
		array('label'=>'Create News','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h3>Quản lý Tin Tức</h3>

<p>
	Có thể nhập các phép so sánh (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>,
	<b>&lt;&gt;</b> hoặc <b>=</b>) trước mỗi giá trị tìm kiếm để tăng độ
	chính xác của kết quả tìm kiếm.
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display: none">
	<?php $this->renderPartial('_search',array(
			'model'=>$model,
)); ?>
</div>
<!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'news-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
		'afterAjaxUpdate'=>"function(){
		jQuery('#created_time_search').datepicker({'dateFormat': 'mm/dd/yy'})
}",
		'columns'=>array(
				array(
						'class' => 'bootstrap.widgets.TbImageColumn',
						'header' => 'Ảnh',
						'imagePathExpression' => 'Yii::app()->request->getBaseUrl(true) . "/../web/images/forumpic/" . $data->image . ".jpg"',
						'htmlOptions' => array('width'=>'60px'),
				),
				array(
			'header' => 'Danh mục',
			'name'=>'category_search',
        	'value'=>'$data->categories->category_name',
			'filter' => CHtml::listData(Categories::model()->findAll(), 'category_id', 'category_name'),
			'htmlOptions' => array('width' => '100px'),
		),
		array(
			'name'=>'title',
        	'value'=>'$data->title',
			'htmlOptions'=>array(
				'width'=>'180px',
			),
		),
		array(
			'name'=>'short_description',
			'value'=> 'substr($data->short_description,0,150)."..."',
			'htmlOptions'=>array(
					'width'=>'180px',
			),
		),
		array(
			'name'=>'created_time',
        	'value'=>'date("d/m/y", $data->created_time)',
			'type' => 'raw',
			'htmlOptions'=>array(
					'width'=>'100px',
			),
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
				'model'=>$model,
				'attribute'=>'created_time',
				'htmlOptions' => array('id' => 'created_time_search'),
				'options' => array('dateFormat' => 'mm/dd/yy')),
				true
			),
		),
		/*
		 'image',
*/
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

<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>

