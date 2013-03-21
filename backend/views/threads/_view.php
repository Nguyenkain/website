<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('thread_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->thread_id),array('view','id'=>$data->thread_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_modified_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_modified_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thread_title')); ?>:</b>
	<?php echo CHtml::encode($data->thread_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thread_content')); ?>:</b>
	<?php echo CHtml::encode($data->thread_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thread_created_time')); ?>:</b>
	<?php echo CHtml::encode($data->thread_created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_posted_time')); ?>:</b>
	<?php echo CHtml::encode($data->last_posted_time); ?>
	<br />


</div>