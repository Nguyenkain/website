
<div class="index">

	<div>
	<?php echo CHtml::image("http://graph.facebook.com/". $data->users->user_avatar ."/picture?type=normal"); ?>
	</div>	
	
	<div>
	<?php echo CHtml::encode($data->users); ?>
	</div>
		
	<div>
	<?php echo CHtml::encode(date("d/m/Y",$data->thread_created_time)); ?>
	</div>
	
	<div>
	<?php echo CHtml::link($data->thread_title,array('threads/view&id='.$data->thread_id)); ?>
	</div>
	
	<div>
	<?php if (isset($data->countpost($data->thread_id)->posts_count))
	echo $data->countpost($data->thread_id)->posts_count;?>
	</div>

</div>