<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Latin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'Loai',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Ho',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Bo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Nhom',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'Img',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'AuthorName',array('class'=>'span5','maxlength'=>50)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
