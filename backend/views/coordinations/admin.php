<?php
$this->breadcrumbs=array(
		'Địa điểm phân bố'=>array('admin'),
		'Quản lý',
);

$this->menu=array(
		array('label'=>'List Coordinations','url'=>array('index')),
		array('label'=>'Create Coordinations','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('coordinations-grid', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<h3>Quản lý địa điểm phân bố</h3>

<!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'coordinations-grid',
		'filter'=>$model,
		'dataProvider'=>$model->search(),
		'template'=>'{summary}{pager}{items}{pager}',
		'pagerCssClass'=>'pagination pagination-right',
		'htmlOptions' => array('class' => 'grid-view rounded'),
		'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
		'columns'=>array(
				array(
				'name' => 'province_name',
				'filter' => CHtml::listData(Coordinations::model()->findAll(array('order' => 'province_name')), 'province_name', 'province_name'),
				),
				array(
					'name' => 'longitude',
					'filter' => false,
				),
				array(
						'name' => 'latitude',
						'filter' => false,
				),
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
