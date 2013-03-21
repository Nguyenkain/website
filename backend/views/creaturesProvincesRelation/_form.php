<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'creatures-provinces-relation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường với ký hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'creature_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'province_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
