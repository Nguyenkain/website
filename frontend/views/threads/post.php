<script type="text/javascript">

function showUpload(btn) {
	$(btn).attr("disabled","disabled");
	$('#post_container .form_upload').show();
	$("#postDialog").dialog("option", "position", 'center');
	$("#postDialog").dialog("option", "width", '1200px');	
}

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
		'enableClientValidation'=>true,
		'id'=>'post_form',
)); ?>
<div id="post_container">
	<div class="content">
		<div class="info_content">
			<div class="avatar">
				<?php echo CHtml::image("http://graph.facebook.com/". $data->user_avatar ."/picture?type=normal"); ?>
				<?php echo $form->textField($model,'user_id',array('style'=>'display:none;',)); ?>
			</div>
			<div class="post_title">
				<label> <?php echo $data->name ?>
				</label>
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
	
	<div class="form_upload" style="display: none;">

		<?php
		$this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/threads/upload"),
                //our XUploadForm
                'model' => $photo,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'post_form'),
                'attribute' => 'file',
                'multiple' => true,
				'autoUpload' => true,
				'options'=>array(
		            'maxNumberOfFiles'=> 4,
		            'acceptFileTypes' => "js:/(\.|\/)(jpg)$/i",
					'sequentialUploads' => true,
					'limitMultiFileUploads' => 4,
		        ),
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'formView' => 'frontend.views.threads.xuploadform',
				'downloadView' => 'frontend.views.threads._download',
         )
);
?>

	</div>
	
	<div class="clearfix"></div>
	
	<div class="button-menu">
	
		<?php $this->widget('bootstrap.widgets.TbButton', array(
				'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
				'label'=>'Đăng ảnh',
				'buttonType' => 'button',
				'htmlOptions' => array(
					'onclick' => 'showUpload(this)',
				),
			));
		
		
		?>

		<?php /* $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType' => 'submit',
				'type'=>'primary',
				'label'=>'Gửi',
		));  */?>

		<?php echo CHtml::ajaxSubmitButton('Gửi',CHtml::normalizeUrl(array('threads/post')),
				array(
                     'dataType'=>'json',
						'type'=>'post',
						'success'=>'function(data) {
                        if(data.status=="success"){
	                 		$("#postDialog").dialog("close");
							$.fn.yiiListView.update("thread_list");
						}
						else {
                        	$.each(data, function(key, val) {
		                        $("#post_form #"+key+"_em_").text(val);
                        			$("#post_form #"+key+"_em_").show();
                        			});
						}
						}',),
				array('id'=>'mybtn','class'=>'btn btn-primary')); ?>

	</div>

</div>
	<?php $this->endWidget(); ?>