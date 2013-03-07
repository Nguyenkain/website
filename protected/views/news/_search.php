<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'vertical',
		'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'news_id'); ?>

	<?php echo $form->textFieldRow($model,'category_id'); ?>

	<?php echo $form->textAreaRow($model,'short_description',array('rows'=>6, 'cols'=>50)); ?>

	<?php echo $form->textAreaRow($model,'news_content',array('rows'=>6, 'cols'=>50)); ?>

	<?php echo $form->textFieldRow($model,'created_time',array('size'=>11,'maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'title',array('size'=>60,'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'image',array('size'=>60,'maxlength'=>225)); ?>

	<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Search')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->