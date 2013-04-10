<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
		)); ?>

<?php echo $form->labelEx($model, 'park_name');
	echo $form->dropDownList($model, 'park_name', CHtml::listData(NationalParks::
		model()->findAll(array('order' => 'park_name')), 'park_name', 'park_name'),
		array('empty' => '--Chọn tên Vườn Quốc Gia--', 'class' => 'span5')); ?>

<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType' => 'submit',
		'type' => 'primary',
		'label' => 'Tìm kiếm',
		)); ?>
</div>

<?php $this->endWidget(); ?>
