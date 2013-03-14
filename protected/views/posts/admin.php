<?php
$this->breadcrumbs=array(
		'Thảo luận'=>array('admin'),
		'Bài viết',
);

$this->menu=array(
		array('label'=>'List Posts','url'=>array('index')),
		array('label'=>'Create Posts','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('posts-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h1>Quản lý bài viết</h1>

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
		'id'=>'posts-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
		'post_id',
		'thread_id',
		array(
			'name' => 'user_search',
			'header' => 'Người viết',
			'value' => '$data->user->name',
        ),
		'post_content',
        array('name'=>'post_created_time',
        'value'=>'date("d/m/y H:i:s", $data->post_created_time)'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );?>
