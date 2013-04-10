<script type="text/javascript">
<!--
function searchTooltip() {
	$('#created_time_search').attr('title','Tìm kiếm những bài có thời gian tạo trước thời gian được chọn');
	$('#created_time_search').attr('rel','tooltip');
	$('#created_time_search').tooltip();
}
//-->
</script>


<?php
$this->breadcrumbs=array(
		'Thảo luận'=>array('admin'),
		'Chủ đề',
);

$this->menu=array(
		array('label'=>'List Threads','url'=>array('index')),
		array('label'=>'Create Threads','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('tooltip','searchTooltip();');

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

<h3>Quản lý chủ đề</h3>

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
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'beforeAjaxUpdate' => 'js:function(id,data){
			$("#threads-grid").addClass("hasLoading");
		}',
		'afterAjaxUpdate' => 'js:function(id,options){
			$("#threads-grid").removeClass("hasLoading");
		}',
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'emptyText' => 'Không có kết quả nào được tìm thấy',
		'columns'=>array(
				/* array(
		            'class'=>'CLinkColumn',
				    'header'=>'Chủ đề',
				    'labelExpression'=>'$data->thread_id',
				    'urlExpression'=>'Yii::app()->createUrl("threads/view",array("id"=>$data->thread_id))',
				), */
				array(
				 'class'=>'bootstrap.widgets.TbRelationalColumn',
						'header'=>'Chủ đề',
						'name' => 'thread_id',
						'url' => Yii::app()->createUrl('threads/relational',array('id'=>'$data->thread_id')),
						'value'=> '$data->thread_id',	
						'htmlOptions'=>array(
							'width'=>'50px',
					),
				),
				array(
					'name' => 'user_search',
					'header'=>'Người viết',
					'value'=>'$data->users',
					'htmlOptions'=>array(
						'width'=>'80px',
					),
				),
				'thread_title',
				'thread_content',
				array(
					'name'=>'thread_created_time',
		        	'value'=>'date("d/m/y H:i:s", $data->thread_created_time)',
					'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
						'model'=>$model, 
						'attribute'=>'thread_created_time', 
						'htmlOptions' => array('id' => 'created_time_search'), 
						'options' => array('dateFormat' => 'mm/dd/yy')), 
						true
					),
				),
				/*
				 'last_posted_time',
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
