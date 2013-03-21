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

	<b><?php echo CHtml::encode($data->getAttributeLabel('Loai')); ?>:</b>
	<?php echo CHtml::encode($data->Loai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
	<?php echo CHtml::encode($data->icon); ?>
	<br />


</div>