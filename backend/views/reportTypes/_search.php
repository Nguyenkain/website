<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'report_type_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'report_type',array('class'=>'span5','maxlength'=>255)); ?>

	<div>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
