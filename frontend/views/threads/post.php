<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
	'enableAjaxValidation'=>true,
	'id'=>'post_form',
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
				'afterValidate'=>'js:function(form,data,hasError){
                        if(!hasError){
								$("#postDialog").dialog("close");
								//window.location = "'.Yii::app()->createUrl('threads/index').'";
								$.fn.yiiListView.update("thread_list");
						}
                 }'
		),
)); ?>
<div id="post_container">
	<div class="content">
		<div class="info_content">
			<div class="avatar">
				<?php echo CHtml::image("http://graph.facebook.com/". $data->user_avatar ."/picture?type=normal"); ?>
				<?php echo $form->textField($model,'user_id',array('style'=>'display:none;',)); ?>
			</div>
			<div class="post_title">
				<label> <?php echo $data->name ?></label> 
				<?php echo $form->textField($model,'thread_title',array('placeholder'=>'Tiêu đề')); ?>
				<?php echo $form->error($model,'thread_title'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="post_content">
			<?php echo $form->textArea($model,'thread_content',array('placeholder'=>'Nội dung')); ?>
			<?php echo $form->error($model,'thread_content'); ?>
		</div>
	</div>
	<div class="button-menu">

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Gửi',
		)); ?>
		
		<?php /* echo CHtml::ajaxSubmitButton('Gửi',CHtml::normalizeUrl(array('threads/post')),
                 array(
                     'dataType'=>'json',
                     'type'=>'post',
                     'success'=>'function(data) {
                        if(data.status=="success"){
	                 		$("#postDialog").dialog("close");
                        }
                         else {
                        	$.each(data, function(key, val) {
		                        $("#post_form #"+key+"_em_").text(val);                                                    
		                        $("#post_form #"+key+"_em_").show();
                        	});
                        }       
                    }',),
				array('id'=>'mybtn','class'=>'btn btn-primary')); */ ?>

	</div>
<?php $this->endWidget(); ?>