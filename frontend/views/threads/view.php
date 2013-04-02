<script>


function postToFacebook($fbId,$threadId)
{
	alert("ádsadsad");
	$.ajax({
	      type: "POST",
	      url:    "<? echo Yii::app()->createUrl('threads/postToFacebook'); ?>",
	      data:  {'facebook_id':$fbId,'thread_id':$threadId},
	      async: false,
	      success: function(msg){
	      },
	      error: function(xhr){
	      }
	    });
}

</script>

<?php $this->renderPartial('_bar',array(
));
?>

<?php 

if(isset($success)) {
	Yii::app()->user->setFlash('success', '<strong>Thành công!</strong> Thông báo của bạn sẽ được gửi tới Admin và xử lý trong thời gian sớm nhất.');
	$this->widget('bootstrap.widgets.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'×', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
				'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
		),
));
}

?>

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
?>

<div id="thread_detail_container">
	<h2 class="thread_title_new">
		<span class="main_topic_title"><?php echo $model->thread_title; ?> </span>
	</h2>

	<div class="thread_block">
		<div class="thread_date">
			<span><?php echo CHtml::encode(date("d/m/y H:i:s", $model->thread_created_time)); ?>
			</span>
		</div>
		<div class="author_block">
			<div class="user_avatar">
				<?php echo CHtml::image("http://graph.facebook.com/". $model->users->user_avatar ."/picture?type=normal"); ?>
			</div>
			<div class="user_name">
				<span><?php echo $model->users->name; ?> </span>
			</div>
		</div>
		<div class="post_body">
			<div class="post_entry_content">
				<?php echo $model->thread_content; ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="thread_control">

			<div class="button">

				<a
					href="javascript:postToFacebook(<?php echo $userid.",".$model->thread_id?>);">Chia
					sẻ</a>

			</div>

			<div class="button">

				<?php EQuickDlgs::ajaxLink(
				array(
				'controllerRoute' => 'report', //'member/view'
				'actionParams' => array('user_id'=>$userid,'thread_id'=>$model->thread_id), //array('id'=>$model->member->id),
				'dialogTitle' => "Báo cáo chủ đề",
				'dialogWidth' => 490,
				'dialogHeight' => 370,
				'openButtonText' => '<span>Báo cáo</span>',
				'closeButtonText' => false,
				'closeOnAction' => true, //important to invoke the close action in the actionCreate
				'openButtonHtmlOptions' => array(),
				)
				);
				?>

			</div>

		</div>
	</div>

	<?php $this->widget('zii.widgets.CListView',array(
			'dataProvider'=>$post_model->search(),
			'itemView'=>'_view',
			'id' => 'post_listview',
			'summaryText'=>false,
			'emptyText'=>false,
			'afterAjaxUpdate' => 'js:function(id, data) {
				$("#submitButton").removeAttr("disabled");
				$("#post_listview").removeClass("hasLoading");
				$(".comment_editor textarea").val("");
			}',
			'beforeAjaxUpdate' => 'js:function(id) {
				$("#post_listview").addClass("hasLoading");
				$("#submitButton").attr("disabled","disabled");
			}',
	))?>

</div>

<div class="comment_container">

	<?php  $form = $this -> beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'user-time-form',
			'type' => 'horizontal',
	));
	?>

	<h3 class="comment_title">Trả lời</h3>

	<div class="comment_box">

		<div class="comment_editor">

			<?php echo $form->textArea($newPost,'post_content',array('rows'=>6, 'cols'=>50, 'placeholder'=>'Nhập nội dung trả lời'));?>

		</div>

		<div class="action_container">

			<?php 

			$this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Gửi',
				'type' => 'primary',
				'url' => Yii::app()->createUrl('threads/newPost', array('thread_id' => $model->thread_id, 'fbid' => $userid)),
				'size' => 'small',
				'buttonType' => 'ajaxSubmit',
				'ajaxOptions' => array(
			            'type' => 'POST',
			            'success' => 'function(data) { 
								$.fn.yiiListView.update("post_listview");
						}',
						'error' => 'function(err) {}',
			            'processData' => false,
			    ),
				'htmlOptions' => array(
					'id'=>'submitButton',
				),
		));

		?>
			<?php 

			$this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Hủy',
				'size' => 'small',
				'buttonType' => 'reset',
		));

		?>

		</div>

	</div>
	<?php $this->endWidget(); ?>
</div>

</div>
