<?php
// example code for the view "_relational" that returns the HTML content
echo CHtml::tag('h3',array(),'Các báo cáo cho chủ đề : '.$title);
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'reports-grid',
	'dataProvider'=>$model->search(),
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'htmlOptions' => array('class' => 'grid-view rounded'),
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
		array(
			'name' => 'user_id',
			'value'=>'$data->user',
		),
		array(
			'name' => 'report_type_id',
			'value'=>'$data->reportType',
			'filter' => CHtml::listData(ReportTypes::model()->findAll(), 'report_type_id', 'report_type'),
		),
		'comment',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
				'buttons'=>array(
						'update'=>array(
								'url'=>'Yii::app()->createUrl("/reports/update", array("id"=>$data->report_id))',
						),
						'delete'=>array(
								'url'=>'Yii::app()->createUrl("/reports/delete", array("id"=>$data->report_id))',
						),
				),
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
		),
	),
)); 
?>