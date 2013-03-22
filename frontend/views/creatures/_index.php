<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id'=>'creatures-form',
		'enableAjaxValidation'=>false,
)); ?>

<?php 
echo $form->labelEx($model,'Ho');
echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' )); ?>


<?php
echo $form->labelEx($model,'Bo');
echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll('ID=:parent_id',
								array(':parent_id'=>(int) $model->Bo)), 'ID', 'Viet' )); ?>
<?php
echo $form->labelEx($model,'Nhom');
		echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll('ID=:parent_id',
								array(':parent_id'=>(int) $model->Nhom)), 'ID', 'Viet' )); ?>
<?php echo CHtml::radioButtonList($data,'Loai',CHtml::listData(Loai::model()->findAll(),'ID','Loai'),array('onchange' => 'menuTypeChange(this.value);'));?>






<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Find' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
