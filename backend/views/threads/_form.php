<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'threads-form',
		'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">
	Trường với ký hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model); ?>

<?php /* echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); */
echo $form->labelEx($model,'user_id');
		echo $form->dropDownList($model,'user_id', CHtml::listData(Users::model()->findAll(), 'user_id', 'name'), array('empty'=>'--hãy lựa chọn--')); ?>

<?php echo $form->textFieldRow($model,'thread_title',array('class'=>'span5','maxlength'=>150)); ?>

<?php echo $form->textAreaRow($model,'thread_content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php
$this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/threads/upload"),
                //our XUploadForm
                'model' => $photo,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'threads-form'),
                'attribute' => 'file',
                'multiple' => true,
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'formView' => 'backend.views.threads.xuploadform',
				'downloadView' => 'backend.views.threads._download',
                )
            );
            ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Lưu mới' : 'Lưu',
		)); ?>
</div>

<?php $this->endWidget(); ?>
