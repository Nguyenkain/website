<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php
echo $form->labelEx($model,'park_name');
echo $form->dropDownList($model,'park_name', CHtml::listData(NationalParks::model()->findAll(array('order' => 'park_name')), 'park_name', 'park_name'), array('empty'=>'--please select--','class'=>'span5')); ?>

<?php echo $form->textAreaRow($model,'park_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php echo $form->textFieldRow($model,'longitude',array('class'=>'span5')); ?>

<?php echo $form->textFieldRow($model,'latitude',array('class'=>'span5')); ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
)); ?>
</div>

<?php $this->endWidget(); ?>
