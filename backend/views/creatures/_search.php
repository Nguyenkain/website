<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php 	echo $form->textFieldRow($model,'Viet',array('class'=>'span5','maxlength'=>50)); ?>

	<?php	echo $form->textFieldRow($model,'Latin',array('class'=>'span5','maxlength'=>50)); ?>

	<?php 	echo $form->labelEx($model,'Loai');
			echo $form->dropDownList($model,'Loai',CHtml::listData(Loai::model()->findAll(), 'ID', 'Loai' ), array('empty'=>'--Chọn loài--',
				'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicloai'),
				'success' => 'function(data){
				$("#Creatures_Nhom").html(data.dropdownNhom);
				$("#Creatures_Bo").html(data.dropdownBo);
				$("#Creatures_Ho").html(data.dropdownHo);

}')));?>
	<?php 	echo $form->labelEx($model,'Nhom');
			echo $form->dropDownList($model,'Nhom',CHtml::listData(Nhom::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--Chọn nhóm--',
                'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicnhom'),
				'success' => 'function(data){
				$("#Creatures_Bo").html(data.dropdownBo);
				$("#Creatures_Ho").html(data.dropdownHo);

}')));?>
	<?php 	echo $form->labelEx($model,'Bo');
			echo $form->dropDownList($model,'Bo',CHtml::listData(Bo::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--Chọn bộ--',
				'ajax' => array(
			 	'type' => 'POST',
				'dataType' => 'json',
				'data' => array('ID' => 'js:$(this).val()'),

				'url' => CController::createUrl('creatures/dynamicbo'),
				'success' => 'function(data){
				$("#Creatures_Ho").html(data.dropdownHo);

}')));?>
	<?php 	echo $form->labelEx($model,'Ho');
			echo $form->dropDownList($model,'Ho',CHtml::listData(Ho::model()->findAll(), 'ID', 'Viet' ), array('empty'=>'--Chọn họ--',));?>
	<?php 
			echo $form->textAreaRow($model,'Description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'Img',array('class'=>'span5','maxlength'=>200)); ?>

	<?php //echo $form->textFieldRow($model,'Author',array('class'=>'span5')); ?>

		<?php 	echo $form->labelEx($model,'AuthorName');
			echo $form->dropDownList($model,'Author',CHtml::listData(Author::model()->findAll(), 'ID', 'Name' ), array('empty'=>'--Chọn tác giả--',));?>

	    <div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
		</div>

<?php $this->endWidget(); ?>

