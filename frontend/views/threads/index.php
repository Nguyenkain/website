<?php 
$userid = Yii::app()->facebook->getUser();

if ($userid)
{
	try
	{
		$fbuid = Yii::app()->facebook->getUser();
		$me = Yii::app()->facebook->api('/me');
	}
	catch(FacebookApiException $e){
		$userid = NULL;
	}
}

if($userid) {
	$url = Yii::app()->facebook->getLogoutUrl();
	$user_info	= Yii::app()->facebook->api('/' . $userid);
	$model = new Users;
	$model->facebook_id = $userid;
	$model->name = $user_info['name'];
	$model->username = $user_info['username'];
	$model->user_avatar = $userid;
	$model->user_email = $user_info['email'];
	$model->user_dob = $user_info['birthday'];
	if(isset($user_info['location']))
		$model->user_address = $user_info['location']['name'];
	$model->addNewUser();
}
else {
	$url = Yii::app()->facebook->getLoginUrl(array(
			'scope'	=> 'read_stream, publish_stream, user_birthday, user_location, email, user_hometown, user_photos',
	));
}

?>

<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<a id="post_button" href="#"><span>Thêm chủ đề</span> </a>
		<h4>Danh mục chủ đề</h4>
		<?php echo CHtml::link('', $url, array('id'=>'facebook_button')); ?>

		<div class="clearfix"></div>
	</div>
	<div class="hoz_line long"></div>
	<div id="thread_container">

		<?php $this->widget('bootstrap.widgets.TbListView',array(
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
