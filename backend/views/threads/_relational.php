<?php
// example code for the view "_relational" that returns the HTML content
echo CHtml::tag('h3',array(),'Các bài viết ở trong chủ đề này :');
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'posts-grid',
	'dataProvider'=>$post_model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'htmlOptions' => array('class' => 'grid-view rounded'),
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
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