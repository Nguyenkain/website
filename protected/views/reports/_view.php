<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->report_id),array('view','id'=>$data->report_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thread_id')); ?>:</b>
	<?php echo CHtml::encode($data->thread_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->report_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>