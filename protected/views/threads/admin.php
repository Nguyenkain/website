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

<h1>Quản lý chủ đề</h1>

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
		'beforeAjaxUpdate' => 'js:function(){
			alert("asdsad");
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
				),
				array(
					'name' => 'user_search',
					'header'=>'Người viết',
					'value'=>'$data->users',
				),
				'thread_title',
				'thread_content',
				array(
					'name'=>'thread_created_time',
			        'value'=>'date("d/m/y H:i:s", $data->thread_created_time)'),
				'last_modified_time',
				/*
				 'last_posted_time',
*/
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); ?>

<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
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

<h1>Quản lý chủ đề</h1>

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
		'beforeAjaxUpdate' => 'js:function(){
			alert("asdsad");
		}',
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
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
				),
				array(
					'name' => 'user_search',
					'header'=>'Người viết',
					'value'=>'$data->users',
				),
				'thread_title',
				'thread_content',
				array(
					'name'=>'thread_created_time',
			        'value'=>'date("d/m/y H:i:s", $data->thread_created_time)'),
				'last_modified_time',
				/*
				 'last_posted_time',
*/
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); ?>

<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
