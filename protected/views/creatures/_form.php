<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'creatures-form',
		'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Fields with <span class="required">*</span> are required.
</p>

<?php echo $form->errorSummary($model); ?>



<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'Latin',array('class'=>'span5','maxlength'=>50)); ?>

<?php echo $form->textFieldRow($model,'Loai',array('class'=>'span5')); ?>

<?php //echo $form->textFieldRow($model,'Nhom',array('class'=>'span5')); ?>
<?php 
echo $form->labelEx($model,'Ho');
echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--',
								'prompt'=>' ',
								'ajax' => array(
								'type'=>'POST',
								'dataType'=>'json',
								'data'=>array('Ho'=>'js:$(this).val()'),

                                'url'=>CController::createUrl('creatures/dynamicbo'),
                                'success'=>'function(data){
                                $("#Creatures_Bo").html(data.dropdownBo);
                                $("#Creatures_Nhom").html(data.dropdownNhom);

}'
		))); ?>
<?php //echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>

<?php
echo $form->labelEx($model,'Bo');
echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll('ID=:parent_id',
								array(':parent_id'=>(int) $model->Bo)), 'ID', 'Viet' ), 
								array(
								
								"readonly"=>"readonly",
			)); ?>
<?php
echo $form->labelEx($model,'Nhom');
		echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll('ID=:parent_id',
								array(':parent_id'=>(int) $model->Nhom)), 'ID', 'Viet' ), 
								array(
								
								"readonly"=>"readonly",
		
		)); ?>




<?php // echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<div class="tinymce">
	<?php echo $form->labelEx($model,'Description'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce',
			array('model'=>$model,
                        'attribute'=>'Description',
                        'editorTemplate'=>'full',
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

<?php echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'AuthorName',array('class'=>'span5','maxlength'=>50)); ?>

<?php $profile = CreaturesProvincesRelation::model()->findByPk(1);
echo $profile->province_id; ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
