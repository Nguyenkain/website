<div class="view">
	<h3>Thông tin Vườn Quốc Gia <?php echo $model->park_name; ?></h3>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('park_name')); ?>:</b>
	<?php echo CHtml::encode($model->park_name); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('park_description')); ?>:</b>
	<?php echo CHtml::encode($model->park_description); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($model->longitude); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($model->latitude); ?>
	<br />


</div>