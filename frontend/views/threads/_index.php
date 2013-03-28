<?php $model = Users::model()->findByPk($data->user_id);?>

<div class="thread_item">
	<div class="avatar">
		<?php echo CHtml::image("http://graph.facebook.com/". $data->users->user_avatar ."/picture?type=normal"); ?>
	</div>
	<div class="thread_info">
		<div class="thread_title_info">
			<img alt="Tiêu đề" src="css/images/thread.png" /> <a
				class="thread_title" href="#"><?php echo CHtml::encode($data->users); ?>
			</a> <label class="date_text"> <?php echo CHtml::encode(date("d/m/Y",$data->thread_created_time)); ?>
			</label>
			<div class="clearfix"></div>
		</div>
		<div class="thread_content">
			<p class="content">
				<?php echo CHtml::link($data->thread_title,array('threads/view&id='.$data->thread_id.'&userid='.$data->user_id)); ?>
			</p>
		</div>
		<div class="thread_stats">
			<label class="stats_text"> (</label> <img alt="Bài viết"
				src="css/images/reply.png" /> <label class="stats_text"> <?php if (isset($data->countpost($data->thread_id)->posts_count))
					echo $data->countpost($data->thread_id)->posts_count;?>
			</label><label class="stats_text"> )</label>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
