<ul class="nav nav-pills nav-stacked active">
	<li class="nav-header">Danh mục</li>

	<?php if(Yii::app()->controller->id == 'categories'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý danh mục',array('categories/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý danh mục',array('categories/admin')); ?>
	</li>
	<?php endif; ?>

	<?php if(Yii::app()->controller->id == 'categories'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm danh mục mới',array('categories/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm danh mục mới',array('categories/create')); ?>
	</li>
	<?php endif;?>

	<li class="nav-header">Tin tức</li>
	<?php if(Yii::app()->controller->id == 'news'  && (Yii::app()->controller->action->id == 'admin' || Yii::app()->controller->action->id == 'update' || Yii::app()->controller->action->id == 'view')):  ?>
	<li class="active"><?php echo CHtml::link('Quản lý tin tức',array('news/admin')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Quản lý tin tức',array('news/admin')); ?></li>
	<?php endif;?>

	<?php if(Yii::app()->controller->id == 'news'  && Yii::app()->controller->action->id == 'create'):  ?>
	<li class="active"><?php echo CHtml::link('Thêm tin mới',array('news/create')); ?>
	</li>
	<?php else: ?>
	<li><?php echo CHtml::link('Thêm tin mới',array('news/create')); ?>
	</li>
	<?php endif;?>
</ul>
