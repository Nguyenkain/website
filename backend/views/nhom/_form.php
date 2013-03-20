<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'nhom-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Trường có kí hiệu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LaTin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php 
		echo $form->labelEx($model,'Loai');
		echo $form->dropDownList($model,'Loai',CHtml::listData(Loai::model()->findAll(), 'ID', 'Loai' ), array('empty'=>'--please select--'
								
				)); ?>

	<?php //echo $form->textFieldRow($model,'icon',array('class'=>'span5','maxlength'=>200)); ?>
	<?php echo $form->labelEx($model,'icon'); ?>
	<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
		array(
				'id'=>'uploadFile',
				'config'=>array(
						'action'=>Yii::app()->createUrl('news/upload'),
						'allowedExtensions'=>array("jpg","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
						'sizeLimit'=>10*1024*1024,// maximum file size in bytes
						'minSizeLimit'=>2*1024,// minimum file size in bytes
						'onComplete'=>"js:function(id, fileName, responseJSON){
						var fileNameReal = responseJSON['fileName'];
						fileNameReal= fileNameReal.replace('.jpg','').replace('.png','');
						$('#News_image').val(fileNameReal); }",
						//'messages'=>array(
						//                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
						//                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
						//                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
						//                  'emptyError'=>"{file} is empty, please select files again without it.",
						//                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
						//                 ),
						//'showMessage'=>"js:function(message){ alert(message); }"
				)
)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'LÆ°u',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
