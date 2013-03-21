<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID),array('view','id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Viet')); ?>:</b>
	<?php echo CHtml::encode($data->Viet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Latin')); ?>:</b>
	<?php echo CHtml::encode($data->Latin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Loai')); ?>:</b>
	<?php echo CHtml::encode($data->Loai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Ho')); ?>:</b>
	<?php echo CHtml::encode($data->Ho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bo')); ?>:</b>
	<?php echo CHtml::encode($data->Bo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nhom')); ?>:</b>
	<?php echo CHtml::encode($data->Nhom); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Img')); ?>:</b>
	<?php echo CHtml::encode($data->Img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Author')); ?>:</b>
	<?php echo CHtml::encode($data->Author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AuthorName')); ?>:</b>
	<?php echo CHtml::encode($data->AuthorName); ?>
	<br />

	*/ ?>

</div>