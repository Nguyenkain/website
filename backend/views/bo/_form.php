<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'bo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model,'Vui lòng kiểm tra lại những lỗi sau:'); ?>

	<?php //echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LaTin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php 
		echo $form->labelEx($model,'Nhom');
		echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--Chọn nhóm--'
								
				)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
