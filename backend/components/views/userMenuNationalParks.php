<ul class="nav nav-pills nav-stacked active">
	<li class="nav-header">Vườn quốc gia</li>

	<?php if(Yii::app()->controller->id == 'nationalParks'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý Vườn quốc gia',array('nationalParks/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý Vườn quốc gia',array('nationalParks/admin')); ?>
	</li>
	<?php endif; ?>

	<?php if(Yii::app()->controller->id == 'nationalParks'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm Vườn quốc gia mới',array('nationalParks/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm Vườn quốc gia mới',array('nationalParks/create')); ?>
	</li>
	<?php endif;?>
</ul>