<?php
$this->breadcrumbs=array(
		'Thảo luận'=>array('admin'),
		'Chủ đề',
);

$this->menu=array(
		array('label'=>'List Threads','url'=>array('index')),
		array('label'=>'Create Threads','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('threads-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h3>Quản lý các chủ đề bị báo cáo</h3>

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
		'id'=>'threads-grid',
		'dataProvider'=>$model->searchReports(),
		'filter'=>$model,
		'beforeAjaxUpdate' => 'js:function(){
		}',
		'afterAjaxUpdate' => 'js:function() {
		}',
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
		'columns'=>array(
				'thread_title',
				'thread_content',
				array(
					'name' => 'user_search',
					'header'=>'Người viết',
					'value'=>'$data->users',
				),
				array(
					'filter'=>false,
					'class'=>'bootstrap.widgets.TbRelationalColumn',
					'header'=>'Số lần báo cáo',
					'name' => 'reports_count',
					'url' => Yii::app()->createUrl('threads/reportsView',array('id'=>'$data->thread_id')),
					'value'=> '$data->reports_count',
				),
				
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{unreport}{update}{delete}',
					'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
					'buttons'=>array(
						'unreport' => array(
							'label'=> 'Bỏ báo cáo',
							'imageUrl'=> '',
							'options'=>array("class" => "icon-eject"),
	 						'url'=>'$this->grid->controller->createUrl("/threads/unreport", array("id"=>$data->thread_id))',
							'click' => 'function(){
									var r = confirm("Bạn có chắc chắn muốn bỏ báo cáo cho chủ đề này ?");
									return r;
	                         }',
							
						),
						'update'=>array(
								'label'=>'Cập nhật',
						),
						'delete'=>array(
								'label'=>'Xóa',
						),
					),
		),
	),
)); ?>

<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
