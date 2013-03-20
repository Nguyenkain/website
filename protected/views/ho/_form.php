<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ho-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường có kí hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>
	

	<?php //echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LaTin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php 
		echo $form->labelEx($model,'Bo');
		echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--'
								
				)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu lại' : 'Lưu?',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
