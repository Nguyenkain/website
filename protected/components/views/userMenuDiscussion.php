<ul class="nav nav-pills nav-stacked active">
	<li class="nav-header">Thảo luận</li>

	<?php if(Yii::app()->controller->id == 'threads'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý chủ đề',array('threads/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý chủ đề',array('threads/admin')); ?>
	</li>
	<?php endif; ?>

	<?php if(Yii::app()->controller->id == 'posts'  && (Yii::app()->controller->action->id == 'admin'|| Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý bài viết',array('posts/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý bài viết',array('posts/admin')); ?>
	</li>
	<?php endif;?>

	<li class="nav-header">Báo cáo</li>
	<?php if(Yii::app()->controller->id == 'reportTypes'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý loại báo cáo',array('reportTypes/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý loại báo cáo',array('reportTypes/admin')); ?>
	</li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'reportTypes'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm loại báo cáo',array('reportTypes/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm loại báo cáo',array('reportTypes/create')); ?>
	</li>
	<?php endif;?>
</ul>
