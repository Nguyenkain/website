<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Viet')); ?>:</b>
	<?php echo CHtml::encode($data->Viet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LaTin')); ?>:</b>
	<?php echo CHtml::encode($data->LaTin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bo')); ?>:</b>
	<?php echo CHtml::encode($data->Bo); ?>
	<br />


</div>