<script>

function getNotification($userid)
{
	$.ajax({
	      type: "POST",
	      url:    "<? echo Yii::app()->createUrl('threads/getNotification'); ?>",
	      data:  {'facebook_id':$userid},
	      async: false,
	      success: function(msg){
		      	var object = $.parseJSON(msg)
		  		var length = object.length;
		  		var notiHtml="";
		  		for(var i = 0; i< length; i++) {
		  			var noti = $.parseJSON($.parseJSON(msg)[i]);
		  			var html = $('#notification_panel').html();
		  			$('#notification_panel .thread_title_noti').text(noti.threads.thread_title);
		  			$('#notification_panel a').attr('href','<? echo Yii::app()->createUrl('threads/view')?>&id='+noti.threads.thread_id);
		  			notiHtml += $('#notification_panel').html();
		  			$('#notification_panel').html(html);
		  		}
		  		$('#notification').attr('title',notiHtml);
	      },
	      error: function(xhr){
	      }
	    });
}

</script>


<?php 
//Yii::app()->clientScript->registerScript('search', "getNotification();");
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
	//Yii::app()->clientScript->registerScript('search', "getNotification($userid);");
}
else {
	$url = Yii::app()->facebook->getLoginUrl(array(
			'scope'	=> 'read_stream, publish_stream, user_birthday, user_location, email, user_hometown, user_photos',
	));
}


?>

<div id="notification_panel" style="display: none">

	<div class="notification_item"
		style="display: block; height: 30px; line-height: 30px;">

		<a href="#"
			style="color: #fff; text-decoration: none; font-size: 12px;">Có người
			đã viết bài mới trong chủ đề : <span
			style="color: #fff; margin: 0; padding: 0; display: inline; font-size: 12px;"
			class="thread_title_noti"></span>
		</a>

	</div>

</div>

<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<?php 
		
		if($userid)
		{
			EQuickDlgs::ajaxLink(
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
		}
		?>
		<h4>Các chủ đề thảo luận</h4>
		<?php
		if(!$userid)
		{
			echo CHtml::link('', $url, array('id'=>'facebook_button'));
		}
		else {
		Yii::app()->clientScript->registerScript('search', "getNotification($userid);");
		$this->widget('ext.tooltipster.tooltipster',
				array(
						'identifier'=>'.tooptipster',
						'options'=>array(
								'animation'=>'grow',
								'interactive'=>true,
								'interactiveTolerance'=>'10000',
								'timer'=>'10000',
								'position'=>'top',
								'onlyOne' => true,
						),
				)
		);
		$this->widget('ext.tooltipster.tooltipster',
		array(
				'identifier'=>'#notification',
				'options'=>array(
						'animation'=>'grow',
						'interactive'=>true,
						'interactiveTolerance'=>'10000',
						'timer'=>'10000',
						'position'=>'top',
						'onlyOne' => true,
						),
				)
		);
		?>
		</td>
		<div id="profile_container">
			<div id="profile" class="tooptipster" title="<img 
				
				
				
				src='http://graph.facebook.com/<?php echo $userid ?>/picture?type=normal'
				width='100' height='100' />
			<?php echo $user_info['name']?>
			<br> <a href='<?php echo $url?>'> Log out</a>">
			<?php echo CHtml::image("http://graph.facebook.com/". $userid ."/picture?type=normal"); ?>
			<label><?php echo $user_info['name']?> </label>
			<div class="clearfix"></div>
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
