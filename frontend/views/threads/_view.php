<div class="thread_block">
	<div class="thread_date">
		<span><?php echo CHtml::encode(date("d/m/y H:i:s", $data->post_created_time)); ?></span>
	</div>
	<div class="author_block">
		<div class="user_avatar">
			<?php echo CHtml::image("http://graph.facebook.com/". $data->users->user_avatar ."/picture?type=normal"); ?>
		</div>
		<div class="user_name">
			<span><?php echo CHtml::encode($data->users); ?></span>
		</div>
	</div>
	<div class="post_body">
		<div class="post_entry_content">
			<?php echo CHtml::encode($data->post_content); ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="thread_control"></div>
</div>