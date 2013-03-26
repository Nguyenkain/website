<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
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
  <?php echo $form->radioButtonList($model,'Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'));?>
  <?php echo $form->textField($model,'Viet',array('placeholder' => 'Tìm Kiếm')); ?>
  <div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
</div>
<?php $this->endWidget(); ?>