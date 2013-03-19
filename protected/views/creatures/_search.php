<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Latin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php 	echo $form->labelEx($model,'Ho');
			echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--',));?>
	<?php 	echo $form->labelEx($model,'Bo');
			echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--',));?>
	<?php 	echo $form->labelEx($model,'Nhom');
			echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--',));?>
	<?php 	echo $form->labelEx($model,'Loai');
			echo $form->dropDownList($model,'Loai',CHtml::listData(Loai::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--please select--',));?>
	<?php 
			echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'Img',array('class'=>'span5','maxlength'=>200)); ?>

	<?php //echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'AuthorName',array('class'=>'span5','maxlength'=>50)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
