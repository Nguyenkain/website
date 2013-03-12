<?php
$this->breadcrumbs=array(
		'Threads'=>array('index'),
		'Quáº£n lÃ½',
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
		'columns'=>array(
				array(
		            'class'=>'CLinkColumn',
				    'header'=>'thread_id',
				    'labelExpression'=>'$data->thread_id',
				    'urlExpression'=>'Yii::app()->createUrl("threads/view",array("id"=>$data->thread_id))',
				),
				'last_modified_time',
				'user_id',
				'thread_title',
				'thread_content',
				'thread_created_time',
				/*
				 'last_posted_time',
*/
				array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
