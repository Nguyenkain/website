<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'post_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'thread_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'post_content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'post_created_time',array('class'=>'span5', 'style'=>'display:none')); ?>

	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'Date',
    // additional javascript options for the date picker plugin
    'options'=>array(
		'dateFormat' => 'mm/dd/y',
		'onSelect'=>"js:function(selectedDate) {
			selectedDate += ' 23:59:59';
    		$('#Posts_post_created_time').val(selectedDate);
    	}",
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        
    ),
    
));?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Tìm kiếm',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
