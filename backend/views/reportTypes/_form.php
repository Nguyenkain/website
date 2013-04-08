<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'report-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường với ký hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model,'Vui lòng kiểm tra lại những lỗi sau:'); ?>

	<?php echo $form->textFieldRow($model,'report_type',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
