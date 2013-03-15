<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reports-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường với ký hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'thread',array('class'=>'span5','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'user',array('class'=>'span5','disabled'=>'disabled')); ?>

	<?php /* echo $form->textFieldRow($model,'report_type_id',array('class'=>'span5')); */ 
		echo $form->labelEx($model,'report_type_id');
		echo $form->dropDownList($model,'report_type_id', CHtml::listData(ReportTypes::model()->findAll(), 'report_type_id', 'report_type'), array('empty'=>'--hãy lựa chọn--'));?>

	<?php echo $form->textFieldRow($model,'comment',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
