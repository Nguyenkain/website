<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'national-parks-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'park_name',array('class'=>'span5','maxlength'=>255)); ?>

<div class="tinymce">
<?php echo $form->labelEx($model,'park_description'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce',
	array('model'=>$model,
                      'attribute'=>'park_description',
                       'editorTemplate'=>'full',
                        'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),)); ?>
	<?php echo $form->error($model,'news_content'); ?>
</div>

	<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5')); ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'Lưu',
)); ?>
</div>

<?php $this->endWidget(); ?>
