<div id="category_content" class="page_content">
	
	<div class="category_name"><?php echo CHtml::encode($title); ?></div>

	<?php

	$this->widget('bootstrap.widgets.TbListView',array(
				'id' => 'news_list',
				'dataProvider'=>$dataProvider,
				'itemView'=>'_list',
				'summaryText'=>false,
				'emptyText'=>'Chưa có thông tin',
				'pager'=>array(
						'header'         => '',
						'firstPageLabel' => '&lt;&lt;',
						'lastPageLabel'  => '&gt;&gt;',
						'nextPageLabel'=>'Tiếp',//overwrite nextPage lable
						'prevPageLabel'=>'Lùi',//overwrite prePage lable
				),
				'pagerCssClass'=>'pagination-right',
				'beforeAjaxUpdate' =>'js:function(id, data) {
				$("#category_content").addClass("hasLoading");
}',
				'afterAjaxUpdate' => 'js:function(id, data) {
				$("#category_content").removeClass("hasLoading");
}'
		));
		?>
	
	<div class="clearfix"></div>

</div>
