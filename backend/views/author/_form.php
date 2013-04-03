<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'author-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php //echo $form->textFieldRow($model,'DOB',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Telephone',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'Email',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Web',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
