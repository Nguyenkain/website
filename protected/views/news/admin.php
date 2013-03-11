<?php
$this->breadcrumbs=array(
	'News'=>array('admin'),
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

<h1>Quản lý Tin Tức</h1>

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
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'news_id',
		'category_id',
		'short_description',
		array('name'=>'created_time',
        'value'=>'date("d/m/y", $data->created_time)'),
		'title',
		/*
		'image',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
