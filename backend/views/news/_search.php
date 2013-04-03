<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'news_id',array('class'=>'span5')); ?>

<?php //echo $form->textFieldRow($model,'category_id',array('class'=>'span5'));
		echo $form->dropDownList($model,'category_id', CHtml::listData(Categories::model()->findAll(), 'category_id', 'category_name'), array('empty'=>'--Chọn danh mục--')); ?>

<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textAreaRow($model,'short_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php echo $form->textAreaRow($model,'news_content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

<?php echo $form->textFieldRow($model,'created_time',array('class'=>'span5','maxlength'=>11, 'style'=>'display:none')); ?>

<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'Date',
    // additional javascript options for the date picker plugin
    'options'=>array(
		'dateFormat' => 'mm/dd/y',
		'onSelect'=>"js:function(selectedDate) {
			selectedDate += ' 23:59:59';
    		$('#News_created_time').val(selectedDate);
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
