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
		<?php EQuickDlgs::ajaxLink(
            array(
                'controllerRoute' => 'post', //'member/view'
                'actionParams' => array('id'=>$userid), //array('id'=>$model->member->id),
                'dialogTitle' => "Viết bài mới",
                'dialogWidth' => 490,
                'dialogHeight' => 370,
                'openButtonText' => '<span>Thêm chủ đề</span>',
                'closeButtonText' => false,
                'closeOnAction' => true, //important to invoke the close action in the actionCreate
                'openButtonHtmlOptions' => array('id' => 'post_button'),
            )
        );
        ?>
		<h4>Các chủ đề thảo luận</h4>
		<?php
$this->widget('ext.tooltipster.tooltipster',
          array(
            'identifier'=>'#profile',
            'options'=>array(        'animation'=>'grow',
        'offsetY'=>'60',
        'interactive'=>true,
        'interactiveTolerance'=>'10000',
        'timer'=>'10000',
        'position'=>'top')
    ));
		if(!$userid)
		{
			echo CHtml::link('', $url, array('id'=>'facebook_button'));
		}
		else {
		?>
</td>
		<div id="profile_container">
			<div id="profile" title="<img src='http://graph.facebook.com/<?php echo $userid ?>/picture?type=normal' width='100' height='100' /> <?php echo $user_info['name']?><br><a href='<?php echo $url?>'> Log out</a>">
				<?php echo CHtml::image("http://graph.facebook.com/". $userid ."/picture?type=normal"); ?>
				<label><?php echo $user_info['name']?></label>
			</div>
			<div class="ver_line"></div>
			<div id="notification">
				<label>Thông báo</label>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php }?>

		<div class="clearfix"></div>
	</div>
	<div class="hoz_line long"></div>
	<div id="thread_container">

		<?php

 $this->widget('bootstrap.widgets.TbListView',array(
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
