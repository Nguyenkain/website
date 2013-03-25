
<div>
<?php echo $thread_title; ?>
</div>

<div>
<?php echo $model->users->name; ?>
</div>

<div>
<?php echo $model->thread_content; ?>
</div>

<div>
<?php $this->widget('zii.widgets.CListView',array(
				'dataProvider'=>$post_model->search(),
				'itemView'=>'_view'))?>
</div>
