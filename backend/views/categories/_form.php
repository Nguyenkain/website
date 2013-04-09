<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường với ký hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model,'Vui lòng kiểm tra lại những lỗi sau:'); ?>

	<?php echo $form->textFieldRow($model,'category_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
