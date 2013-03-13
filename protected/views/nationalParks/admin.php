<?php $this->breadcrumbs = array(
		'Vườn Quốc Gia' => array('index'),
		'Quản lý',
		);

	$this->menu = array(
		array('label' => 'Liệt kê Vườn Quốc Gia', 'url' => array('index')),
		array('label' => 'Tạo mới Vườn Quốc Gia', 'url' => array('create')),
		);

	Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('national-parks-grid', {
		data: $(this).serialize()
	});
	return false;
});
"); ?>

<h1>Quản lý Vườn Quốc Gia</h1>

<p>
Có thể nhập các phép so sánh (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
hoặc <b>=</b>) trước mỗi giá trị tìm kiếm để tăng độ chính xác của kết quả tìm kiếm.
</p>

<?php echo CHtml::link('Tìm kiếm nâng cao', '#', array('class' =>
		'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search', array('model' => $model, )); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'national-parks-grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			'id',
			'park_name',
			CHtml::decode('park_description'),
			'longitude',
			'latitude',
			array('class' => 'bootstrap.widgets.TbButtonColumn', ),
			),
		)); ?>
