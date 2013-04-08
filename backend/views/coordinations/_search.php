<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php echo $form->labelEx($model, 'province_name');
	echo $form->dropDownList($model, 'province_name', CHtml::listData(Coordinations::
		model()->findAll(array('order' => 'province_name')), 'province_name', 'province_name'),
		array('empty' => '--Chọn địa điểm phân bố--', 'class' => 'span5')); ?>
		
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
