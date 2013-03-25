  	<?php $form=$this->beginWidget('CActiveForm',array(
								'id'=>'creatures-form',
								'enableAjaxValidation'=>false,
						)); ?>
  <?php echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn lớp muốn tìm--',
                                		'id' => 'filter_lop', 'class' => 'filter_ddl') ); ?>
  <?php echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn bộ muốn tìm--',
                                		'id' => 'filter_bo', 'class' => 'filter_ddl')); ?>
  <?php echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array(
                                		'empty'=>'--Chọn họ muốn tìm--',
                                		'id' => 'filter_ho', 'class' => 'filter_ddl') ); ?>
  <?php echo CHtml::radioButtonList('radio','Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'));?>
</div><!-- search-form -->
<?php $this->endWidget(); ?>
<?php 

	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'creatures-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>'{summary}{pager}{items}{pager}',
	'pagerCssClass'=>'pagination pagination-right',
	'summaryText' => 'Hiển thị kết quả từ {start} đến {end} trong tổng cộng {count} kết quả',
	'emptyText' => 'Không có kết quả nào được tìm thấy',
	'columns'=>array(
			array(
					'class' => 'bootstrap.widgets.TbImageColumn',
					'header' => 'Ảnh',
					'imagePathExpression' => 'Yii::app()->request->getBaseUrl(true) . "/images/forumpic/" . $data->Img . ".jpg"',
					'htmlOptions' => array('width'=>'60px'),
			),
			
		array(
	'name'=>'Viet',
	'header'=>'Tên Việt/Tên Latin',
	'value'=>'$data->Viet."/".$data->Latin',

),
				array(
		'name'=>'Nhom',
		
		'filter' => CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rNhom',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		array(
		'name'=>'Bo',
		
		'filter' => CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rBo',
		'htmlOptions'=>array(
		'width'=>'130px',
)),
		
array(
		'name' => 'Ho',
		'header'=>'Họ',
		'filter' => CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet'),
		'value'=>'$data->rHo',
'htmlOptions'=>array(
		'width'=>'130px',
)),
	/*	'Description',*/
	/*	'Img',        */
	/*	'Author',     */
	//	'AuthorName',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'deleteConfirmation'=>"js:'Bạn có chắc chắn muốn xóa dữ liệu này?'",
),
	),
)); ?>
