<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ho-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Những trường có dấu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LaTin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'LÆ°u má»›i' : 'LÆ°u',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
