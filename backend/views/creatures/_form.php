<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'creatures-form',
		'enableAjaxValidation' => false,
		));?>

<p class="help-block">
	Trường có kí hiệu <span class="required">*</span> là bắt buộc.
</p>

<?php echo $form->errorSummary($model); ?>



<?php echo $form->textFieldRow($model, 'Viet', array('class' => 'span5',
		'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 'Latin', array('class' => 'span5',
		'maxlength' => 50)); ?>



<?php //echo $form->textFieldRow($model,'Nhom',array('class'=>'span5')); ?>
<?php echo $form->labelEx($model, 'Ho');
echo $form->dropDownList($model, 'Ho', CHtml::listData(Ho::model()->findAll(),'ID', 'Viet'), 
				array('empty' => '--Chọn họ cho sinh vật--', 'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('Ho' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamiccreate'),
				'success' => 'function(data){
				$("#Creatures_Bo").html(data.dropdownBo);
				$("#Creatures_Nhom").html(data.dropdownNhom);
				$("#Creatures_Loai").html(data.dropdownLoai);

}'))); ?>
<?php //echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>

<?php echo $form->labelEx($model, 'Bo');
echo $form->dropDownList($model, 'Bo', CHtml::listData(Bo::model()->findAll('ID=:parent_id',
		array(':parent_id' => (int)$model->Bo)), 'ID', 'Viet'), array("readonly" =>
			"readonly", )); ?>
<?php echo $form->labelEx($model, 'Nhom');
echo $form->dropDownList($model, 'Nhom', CHtml::listData(Nhom::model()->findAll
		('ID=:parent_id', array(':parent_id' => (int)$model->Nhom)), 'ID', 'Viet'),
		array("readonly" => "readonly", )); ?>
<?php echo $form->labelEx($model, 'Loai');
echo $form->dropDownList($model, 'Loai', CHtml::listData(Loai::model()->findAll
		('ID=:parent_id', array(':parent_id' => (int)$model->Loai)), 'ID', 'Loai'),
		array("readonly" => "readonly", )); ?>




<?php // echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
<div class="tinymce">
	<?php echo $form->labelEx($model, 'Description'); ?>
	<br />
	<?php $this->widget('application.extensions.tinymce.ETinyMce', array(
			'model' => $model,
			'attribute' => 'Description',
			'editorTemplate' => 'full',
			'htmlOptions' => array(
					'rows' => 6,
					'cols' => 50,
					'class' => 'tinymce'),
		)); ?>
	<?php echo $form->error($model, 'Description'); ?>
</div>

<?php echo $form->textField($model, 'Img', array(
		'class' => 'span5',
		'maxlength' => 255,
		'style' => 'display:none')); ?>

<?php echo $form->labelEx($model, 'rRelation'); ?>
<?php $data = CHtml::listData(Coordinations::model()->findAll(array('order' =>
		'province_name')), 'province_id', 'province_name');
$this->widget('ext.EchMultiSelect.EchMultiSelect', array(
		'model' => Coordinations::model(),
		'dropDownAttribute' => 'province_id',
		'data' => $data,
		'value'=> Coordinations::model()->province_id=CHtml::listData($coordinations, 'province_id', 'province_id'),
		'dropDownHtmlOptions' => array('style' => 'width:400px;', ),
		'options' => array(
				'minWidth' => 350,
				'position' => array('my' => 'left top', 'at' => 'left top'),
				'filter' => true,
		),
		'filterOptions' => array('width' => 70,),
)); ?>

<?php //echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>
<?php echo $form->labelEx($model, 'Author');
echo $form->dropDownList($model, 'Author', CHtml::listData(Author::model()->
		findAll(), 'ID', 'Name'), array('empty' => '--Chọn tác giả--', 'onChange' => "$('#AuthorName').val($('#Creatures_Author option:selected').text());")); ?>

<?php echo $form->textField($model, 'AuthorName', array(
		'class' => 'span5',
		'maxlength' => 255,
		'style' => 'display:none',
		'id' => 'AuthorName')); ?>
<?php //echo $form->textFieldRow($model,'AuthorName',array('class'=>'span5','maxlength'=>50)); ?>
<?php echo $form->labelEx($model, 'Img'); ?>
<?php /* $this->widget('ext.EAjaxUpload.EAjaxUpload', array('id' => 'uploadFile',
		'config' => array(
				'action' => Yii::app()->createUrl('creatures/upload'),
				'allowedExtensions' => array("jpg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
				'sizeLimit' => 10 * 1024 * 1024, // maximum file size in bytes
				'minSizeLimit' => 2 * 1024, // minimum file size in bytes
				'onComplete' => "js:function(id, fileName, responseJSON){
				var fileNameReal = responseJSON['filename'];
				fileNameReal= fileNameReal.replace('.jpg','').replace('.png','');
				$('#Creatures_Img').val(fileNameReal); }",
				//'messages'=>array(
				//                  'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
				//                  'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
				//                  'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
				//                  'emptyError'=>"{file} is empty, please select files again without it.",
				//                  'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
				//                 ),
				//'showMessage'=>"js:function(message){ alert(message); }"
			))); */ ?>
			
<?php
$this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/creatures/upload"),
                //our XUploadForm
                'model' => $photo,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'creatures-form'),
                'attribute' => 'file',
                'multiple' => true,
				'autoUpload' => true,
				'options'=>array(
		            'maxNumberOfFiles'=> 4,
		            'acceptFileTypes' => "js:/(\.|\/)(jpg)$/i",
					'sequentialUploads' => true,
					'limitMultiFileUploads' => 4,
		        ),
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'formView' => 'backend.views.creatures.xuploadform',
				'downloadView' => 'backend.views.creatures._download',
         )
);
?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type' => 'primary',
			'label' => $model->isNewRecord ? 'Tạo mới' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
