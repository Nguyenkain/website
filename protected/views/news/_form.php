<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'news-form',
		'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Fields with <span class="required">*</span> are required.
</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'category_id',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'image',array('class'=>'span5','maxlength'=>225)); ?>

<?php echo $form->textAreaRow($model,'short_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<div class="tinymce">
	<?php echo $form->labelEx($model,'news_content'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce',
			array('model'=>$model,
                      'attribute'=>'news_content',
                       'editorTemplate'=>'full',
                        'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),)); ?>
	<?php echo $form->error($model,'news_content'); ?>
</div>

<?php echo $form->textFieldRow($model,'created_time',array('class'=>'span5','maxlength'=>11)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
