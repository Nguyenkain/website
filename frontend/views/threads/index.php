<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<a id="post_button" href="#"><span>Thêm chủ đề</span> </a>
		<h4>Danh mục chủ đề</h4>
		<a id="facebook_button" href="#"></a>
		<div class="clearfix"></div>
	</div>
	<div class="hoz_line long"></div>
	<div id="thread_container">

		<?php $this->widget('zii.widgets.CListView',array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_index',
				'summaryText'=>false,
				'emptyText'=>'Hiện thảo luận chưa có bài viết nào, hãy đóng góp bài viết cho chúng tôi',
		));
		?>

	</div>
</div>
