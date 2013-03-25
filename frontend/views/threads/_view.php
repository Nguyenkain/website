<div>
	<?php echo CHtml::encode($data->users); ?>
</div>

<div>
	<?php echo CHtml::encode($data->post_content); ?>
</div>

<div>
	<?php echo CHtml::encode(date("d/m/y H:i:s", $data->post_created_time)); ?>
</div>