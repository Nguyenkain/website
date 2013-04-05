<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
<div id="post_container">
	<div class="content">
		<div class="info_content">
			<div class="avatar">
				<?php echo CHtml::image("http://graph.facebook.com/". $data->user_avatar ."/picture?type=normal"); ?>
				<?php echo $form->textField($model,'user_id',array('style'=>'display:none;')); ?>
				<?php echo $form->textField($model,'thread_id',array('style'=>'display:none;')); ?>
			</div>
			<div class="post_title">
				<label> <?php echo $data->name ?></label> 
				<?php echo $form->dropDownList($model,'report_type_id',CHtml::listData(ReportTypes::model()->findAll(), 'report_type_id', 'report_type' )) ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="post_content">
			<?php echo $form->textArea($model,'comment',array('placeholder'=>'Chú thích')); ?>
		</div>
	</div>
	<div class="button-menu">

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Gửi',
		)); ?>

	</div>
<?php $this->endWidget(); ?>