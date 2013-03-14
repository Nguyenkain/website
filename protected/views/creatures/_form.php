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

	<?php //echo $form->textFieldRow($model,'Nhom',array('class'=>'span5')); ?>
	<?php 
		echo $form->labelEx($model,'Nhom');
		echo $form->dropDownList($model,'ID',CHtml::listData(nhom::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--')); ?>
	<?php //echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>
	
	<?php
		echo $form->labelEx($model,'Bo');
		echo $form->dropDownList($model,'ID',CHtml::listData(bo::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--')); ?>
	<?php
		echo $form->labelEx($model,'Ho');
		echo $form->dropDownList($model,'ID',CHtml::listData(ho::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--')); ?>
	

	

	<?php // echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<div class="tinymce">
	<?php echo $form->labelEx($model,'Description'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce',
			array('model'=>$model,
                       'attribute'=>'Description',
                       'editorTemplate'=>'simple',
                        'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),)); ?>
	<?php echo $form->error($model,'Description'); ?>
</div>
	<?php // echo $form->textFieldRow($model,'Img',array('class'=>'span5','maxlength'=>200)); ?>
	
	<?php  echo $form->labelEx($model,'Img'); ?>
	<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
		array(
				'id'=>'uploadFile',
				'config'=>array(
						'action'=>Yii::app()->createUrl('creatures/upload'),
						'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
						'sizeLimit'=>10*1024*1024,// maximum file size in bytes
						'minSizeLimit'=>2*1024,// minimum file size in bytes
						'onComplete'=>"js:function(id, fileName, responseJSON){
						var fileNameReal = responseJSON['filename'];
						fileNameReal= fileNameReal.replace('.jpg','').replace('.png','');
						$('#News_image').val(fileNameReal); }",
					//	'messages'=>array(
					//	                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
					//	                 'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
					//	                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
					//	                 'emptyError'=>"{file} is empty, please select files again without it.",
					//	                 'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
					//	                 ),
				//		'showMessage'=>"js:function(message){ alert(message); }"
				)
)); ?>

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
