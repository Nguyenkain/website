<?php
$this->pageTitle=Yii::app()->name . ' - Đăng nhập';
$this->breadcrumbs=array(
	'Đăng nhập',
);
?>

<p>Hãy điền đầy đủ thông tin sau để đăng nhập:</p>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>'well'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Các trường có dấu <span class="required">*</span> là bắt buộc.</p>

	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3'));?>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3'));?>
	<?php echo $form->checkBoxRow($model, 'rememberMe');?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary','label'=>'Gửi', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'Xóa'));?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->
