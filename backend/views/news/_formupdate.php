<?php 
echo CHtml::label('Ảnh','',array());

$this->widget('ext.imageSelect.ImageSelect',  array(
		'id' => 'image_upload',
		'path'=> '/../web/images/forumpic/'.$model->image.'.jpg',
		'alt'=>'alt text',
		'text' => 'Đổi Ảnh',
		'uploadUrl'=>Yii::app()->createUrl('news/change',array('id'=>$model->news_id)),
		'htmlOptions'=>array('style' => "width:auto; height:150px; margin-right: 10px;"),
));

?>

<div class='clearfix'></div>
<br/>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'news-form',
		'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldRow($model,'category_id',array('class'=>'span5'));
echo $form->labelEx($model,'category_id');
		echo $form->dropDownList($model,'category_id', CHtml::listData(Categories::model()->findAll(), 'category_id', 'category_name'), array('empty'=>'--please select--')); ?>

<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->labelEx($model,'image'); ?>

<?php echo $form->textField($model,'image',array('class'=>'span5','maxlength'=>255,'style' =>'display:none')); ?>

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

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Tạo mới' : 'Lưu',
		)); ?>
</div>

<?php $this->endWidget(); ?>
