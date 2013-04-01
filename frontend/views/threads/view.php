
<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<a id="post_button" href="#"><span>Thêm chủ đề</span> </a>
		<h4>Danh mục chủ đề</h4>
		<a id="facebook_button" href="#"></a>
		<div class="clearfix"></div>
	</div>
	<div class="hoz_line long"></div>
	<div id="thread_detail_container">
		<h2 class="thread_title_new">
			<span class="main_topic_title"><?php echo $model->thread_title; ?> </span>
		</h2>

		<div class="thread_block">
			<div class="thread_date">
				<span><?php echo CHtml::encode(date("d/m/y H:i:s", $model->thread_created_time)); ?></span>
			</div>
			<div class="author_block">
				<div class="user_avatar">
					<?php echo CHtml::image("http://graph.facebook.com/". $model->users->user_avatar ."/picture?type=normal"); ?>
				</div>
				<div class="user_name">
					<span><?php echo $model->users->name; ?></span>
				</div>
			</div>
			<div class="post_body">
				<div class="post_entry_content">
					<?php echo $model->thread_content; ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="thread_control"></div>
		</div>
		
		<?php $this->widget('zii.widgets.CListView',array(
			'dataProvider'=>$post_model->search(),
				'itemView'=>'_view'))?>
		
	</div>
</div>
