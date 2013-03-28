<?php $this->renderPartial('_bar',array(
		));
?>

<div id="thread_container">

	<?php

	$this->widget('bootstrap.widgets.TbListView',array(
				'id' => 'thread_list',
				'dataProvider'=>$dataProvider,
				'itemView'=>'_index',
				'summaryText'=>false,
				'emptyText'=>'Hiện thảo luận chưa có bài viết nào, hãy đóng góp bài viết cho chúng tôi',
				'pager'=>array(
						'header'         => '',
						'firstPageLabel' => '&lt;&lt;',
						'lastPageLabel'  => '&gt;&gt;',
						'nextPageLabel'=>'Tiếp',//overwrite nextPage lable
						'prevPageLabel'=>'Lùi',//overwrite prePage lable
				),
				'pagerCssClass'=>'pagination-right',
				'beforeAjaxUpdate' =>'js:function(id, data) {
				$("#thread_container").addClass("hasLoading");
}',
				'afterAjaxUpdate' => 'js:function(id, data) {
				$("#thread_container").removeClass("hasLoading");
}'
		));
		?>

</div>
</div>
