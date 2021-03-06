<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'threads-form',
		'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model,'Vui lòng kiểm tra lại những lỗi sau:'); ?>

<?php /* echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); */
echo $form->labelEx($model,'user_id');
		echo $form->dropDownList($model,'user_id', CHtml::listData(Users::model()->findAll(), 'user_id', 'name'), array('empty'=>'--hãy lựa chọn--')); ?>

<?php echo $form->textFieldRow($model,'thread_title',array('class'=>'span5','maxlength'=>150)); ?>

<?php echo $form->textAreaRow($model,'thread_content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'Lưu',
		)); ?>
</div>

<?php $this->endWidget(); ?>
