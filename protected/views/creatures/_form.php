<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'creatures-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Latin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Loai',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'category_id',array('class'=>'span5'));
		echo $form->labelEx($model,'ID');
		echo $form->dropDownList($model,'ID',CHtml::listData(ho::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--')); ?>
	

	<?php echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nhom',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'Img',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'AuthorName',array('class'=>'span5','maxlength'=>50)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
