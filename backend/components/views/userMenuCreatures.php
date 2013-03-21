<ul class="nav nav-pills nav-stacked active">
	<li class="nav-header">Sinh vật</li>

	<?php if(Yii::app()->controller->id == 'creatures'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý sinh vật',array('creatures/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý sinh vật',array('creatures/admin')); ?>
	</li>
	<?php endif; ?>

	<?php if(Yii::app()->controller->id == 'creatures'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm sinh vật mới',array('creatures/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm sinh vật mới',array('creatures/create')); ?>
	</li>
	<?php endif;?>

	<li class="nav-header">Họ sinh vật</li>
	<?php if(Yii::app()->controller->id == 'ho'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý họ',array('ho/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý họ',array('ho/admin')); ?></li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'ho'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm họ mới',array('ho/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm họ mới',array('ho/create')); ?>
	</li>
	<?php endif;?>
    
    
    <li class="nav-header">Bộ sinh vật</li>
	<?php if(Yii::app()->controller->id == 'bo'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý bộ',array('bo/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý bộ',array('bo/admin')); ?></li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'bo'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm bộ mới',array('bo/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm bộ mới',array('bo/create')); ?>
	</li>
	<?php endif;?>
	
	<li class="nav-header">Nhóm sinh vật</li>
	<?php if(Yii::app()->controller->id == 'nhom'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý nhóm',array('nhom/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý nhóm',array('nhom/admin')); ?></li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'nhom'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm nhóm mới',array('nhom/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm nhóm mới',array('nhom/create')); ?>
	</li>
	<?php endif;?>
	
		<li class="nav-header">Quản lý tác giả</li>
	<?php if(Yii::app()->controller->id == 'author'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý tác giả',array('author/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý tác giả',array('author/admin')); ?></li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'author'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm tác giả mới',array('author/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm tác giả mới',array('author/create')); ?>
	</li>
	<?php endif;?>
</ul>