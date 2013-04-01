<?php 
function checkUrl($url) {
	@$headers = get_headers($url);
	if (preg_match('/^HTTP\/\d\.\d\s+(200|301|302)/', $headers[0])){
		return true;
	}
	else return false;
}?>

<?php 

$url ="";
if($model->Loai == 1) {
	$url = 'animal';
}
else if($model->Loai == 2) {
	$url = 'plant';
}
else if($model->Loai == 3) {
	$url = 'insect';
}

?>

<?php 
echo CHtml::label('Ảnh','',array());

for($i = 0; $i <= 4; $i++) {
	$urlcheck = Yii::app()->getBaseUrl(true);
	$name = "";
	if($i != 0) {
		$name = $model->ID.'_'.$i;
		$urlcheck .= '/../web/images/pictures/'.$url.'/'.$name.'.jpg';
	}
	else {
		$name = $model->ID;
		$urlcheck .= '/../web/images/pictures/'.$url.'/'.$name.'.jpg';
	}
	if(checkUrl($urlcheck)) {

		$this->widget('ext.imageSelect.ImageSelect',  array(
				'id' => 'image_upload',
		        'path'=> $urlcheck,
		        'alt'=>'alt text',
				'text' => 'Đổi Ảnh',
		        'uploadUrl'=>Yii::app()->createUrl('creatures/change',array('id'=>$model->ID, 'name' =>$name)),
		        'htmlOptions'=>array('style' => "width:auto; height:150px; margin-right: 10px;"),
		   ));
	}
}

?>
<div style="clear:both;">
<br />
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

				'url' => CController::createUrl('creatures/dynamicbo'),
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
<?php $data = CHtml::listData(Coordinations::model()->findAll(array('order' =>'province_name')), 'province_id', 'province_name');
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

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type' => 'primary',
			'label' => $model->isNewRecord ? 'Tạo mới' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
