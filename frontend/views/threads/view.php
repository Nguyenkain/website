<script>


function postToFacebook($fbId,$threadId)
{
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

<script>

function setNotification($userid,$threadid)
{
	$.ajax({
	      type: "POST",
	      url:    "<? echo Yii::app()->createUrl('threads/setNotification'); ?>",
	      data:  {'facebook_id':$userid,'thread_id':$threadid},
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
//Yii::app()->clientScript->registerScript('search', "getNotification();");

Yii::app()->clientScript->registerScript('setNoti', "setNotification($userid,$model->thread_id);");
if(isset(Yii::app()->session['userid']))
	$user_id = Yii::app()->session['userid'];
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

			<?php 
			if($userid) { ?>

			<div class="button">

				<a
					href="javascript:postToFacebook(<?php echo $userid.",".$model->thread_id?>);">Chia
					sẻ</a>

			</div>

			<div class="button">

				<?php 
				
				if($user_id == $model->user_id) {
					EQuickDlgs::ajaxLink(
						array(
							'controllerRoute' => 'delete', //'member/view'
							'actionParams' => array('user_id'=>$user_id,'thread_id'=>$model->thread_id), //array('id'=>$model->member->id),
							'dialogTitle' => "Xóa",
							'dialogWidth' => 490,
							'dialogHeight' => 370,
							'openButtonText' => '<span>Xóa</span>',
							'closeButtonText' => false,
							'closeOnAction' => true, //important to invoke the close action in the actionCreate
							'openButtonHtmlOptions' => array(),
						)
					);
				}
				else {
					EQuickDlgs::ajaxLink(
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
				}
				?>

			</div>

			<?php }?>

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

<?php 
if($userid) {

?>

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
								debugger;
								$.fn.yiiListView.update("post_listview");
						}',
						'error' => 'function(err) {debugger;}',
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

<?php }?>

</div>
