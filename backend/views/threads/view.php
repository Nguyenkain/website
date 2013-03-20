<?php
$this->breadcrumbs=array(
	'Quản trị chủ đề'=>array('admin'),
	$thread_title,
);
?>

<h1>Thông tin bài <?php echo $thread_title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'thread_title',
		'thread_content',
		array(
			'name' => 'Người viết',
			'header' => 'Người viết',
			'value' => $model->users->name,
        ),
		'thread_content',
        array(
			'name'=>'thread_created_time',
	        'value'=>date("d/m/y H:i:s", $model->thread_created_time)
		),
		'last_modified_time',
	),
)); ?>

<h3>Các bài viết trong bài <?php echo $thread_title; ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'posts-grid',
	'dataProvider'=>$post_model->search(),
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'htmlOptions' => array('class' => 'grid-view rounded'),
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'columns'=>array(
		'post_id',
		'user_id',
		array(
			'name' => 'thread_search',
			'header' => 'Chủ đề',
			'value' => '$data->threads',
        ),
		'post_content',
        array('name'=>'post_created_time',
        'value'=>'date("d/m/y H:i:s", $data->post_created_time)'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'buttons'=>array(
					'update'=>array(
							'url'=>'Yii::app()->createUrl("/posts/update", array("id"=>$data->post_id))',
					),
					'delete'=>array(
							'url'=>'Yii::app()->createUrl("/posts/delete", array("id"=>$data->post_id))',
					),
					'view'=>array(
							'url'=>'Yii::app()->createUrl("/posts/view", array("id"=>$data->post_id))',
					),
			),
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); ?>
