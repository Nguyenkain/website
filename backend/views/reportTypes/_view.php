<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->report_type_id),array('view','id'=>$data->report_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_type')); ?>:</b>
	<?php echo CHtml::encode($data->report_type); ?>
	<br />


</div>