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
		  		var countNoti = 0;
		  		for(var i = 0; i< length; i++) {
		  			var noti = $.parseJSON($.parseJSON(msg)[i]);
		  			var html = $('#notification_panel').html();
		  			if(noti.viewed_status == 0){
			  			countNoti++;
			  			$('#notification_panel .notification_item').addClass('newNoti');
		  			}
		  			$('#notification_panel .thread_title_noti').text(noti.threads.thread_title);
		  			$('#notification_panel a').attr('href','<? echo Yii::app()->createUrl('threads/view')?>&id='+noti.threads.thread_id);
		  			notiHtml += $('#notification_panel').html();
		  			$('#notification_panel').html(html);
		  		}
		  		if(countNoti > 0) {
			  		$('#notification .noti_number').show();
			  		$('#notification .noti_number').text(countNoti);
		  		}
		  		$('#notification').attr('title',notiHtml);
	      },
	      error: function(xhr){
	      }
	    });
}

</script>


<?php 
if(isset(Yii::app()->session['userid']))
{
	$user_id = Yii::app()->session['userid'];
	$ban = Users::model()->findByPk($user_id)->ban_status;
	if($ban == 1)
	{
		Yii::app()->clientScript->registerScript('warning', "showWarning()");
	}
}
$userid = Yii::app()->facebook->getUser();

if ($userid)
{
	try
	{
		$fbuid = Yii::app()->facebook->getUser();
		$user_info	= Yii::app()->facebook->getInfo();
		$url = Yii::app()->facebook->getLogoutUrl();
	}
	catch(FacebookApiException $e){
		$userid = NULL;
		Yii::app()->facebook->destroySession();
	}
}


?>

<div id="notification_panel" style="display: none">

	<div class="notification_item"
		style="display: block; height: 30px; line-height: 30px;">

		<a href="#" style="text-decoration: none; font-size: 12px;">Có người
			đã viết bài mới trong chủ đề : <span
			style="color: #fff; margin: 0; padding: 0; display: inline; font-size: 12px;"
			class="thread_title_noti"></span>
		</a>

	</div>

</div>

<div id="discussion_content" class="page_content">
	<div id="action_nav">
		<?php 

		if($userid && $ban)
		{
			/* EQuickDlgs::ajaxLink(
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
			); */

			echo CHtml::ajaxLink("<span>Thêm chủ đề </span>",$this->createUrl('threads/post',array('id'=>$userid)),array(
				'onclick'=>'$("#postDialog").dialog("open"); return false;',
				'update' => '#postDialog'
        	),
			array('id'=>'post_button')); 
		}
		?>
		<div id="postDialog"></div>
		<h4>Các chủ đề thảo luận</h4>
		<?php
		if(!$userid)
		{
			echo CHtml::link('', "", array(
						'id'=>'facebook_button',
						'onclick'=>'javascript: window.open("'.$this->createUrl('threads/login').'");'));
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
						'interactiveTolerance'=>'1110000',
						'timer'=>'1110000',
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
			<label>Thông báo</label> <span class="noti_number"
				style="display: none"></span>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php }?>

	<div class="clearfix"></div>
</div>
<div class="hoz_line long"></div>
