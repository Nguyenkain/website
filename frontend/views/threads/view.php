<?php 
function checkUrl($url) {
	@$headers = get_headers($url);
	if (preg_match('/^HTTP\/\d\.\d\s+(200|301|302)/', $headers[0])){
		return true;
	}
	else return false;
}?>


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

function showEditor(btn)
{
	$(btn).parents('.thread_block').find('.post_entry_content').hide();
	$(btn).parents('.thread_block').find('.post_edit_content').show();
}

function closeEditor(btn)
{
	$(btn).parents('.thread_block').find('.post_entry_content').show();
	$(btn).parents('.thread_block').find('.post_edit_content').hide();
}

function editPost(btn)
{
	var form = $(btn).parents('form');
	$.ajax({
	      type: "POST",
	      url:    form.attr("action"),
	      data:  form.serialize(),
	      success: function(data){
	    	  	$model = $.parseJSON(data);
				$(btn).parents(".thread_block").find(".post_entry_content").html($model.post_content);
				closeEditor(btn);
	      },
	      error: function(xhr){
		      debugger;
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
			<div class="post_entry_image">
				<?php foreach ($images as $image)
				{
					$link = Yii::app()->request->getBaseUrl(true).$image->image_link;
					if(checkUrl($link))
				?>
					<a href="<?php echo $link?>">
					<?php 
						echo CHtml::image($link,"Ảnh chủ đề",array('style' => 'width:80px;height:auto;margin-right:10px'));
					?>
					</a>
				<?php }
				
				// import the extension
				Yii::import('ext.jqPrettyPhoto');
				
				$options = array(
						'slideshow'=>5000,
						'autoplay_slideshow'=>false,
						'show_title'=>false,
						'default_width' => 500,
						'allow_resize' => true,
				);
				// call addPretty static function
				jqPrettyPhoto::addPretty('.post_entry_image a',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);
				
				?>
			</div>
			<div class="post_edit_content" style="display:none">
			<?php if($userid && ($user_id==$model->user_id)) 
			{
			?>
				<?php  $form = $this -> beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'thread_edit_form',
						'type' => 'horizontal',
				));
				?>
				
				<?php echo $form->textArea($model,'thread_content',array('rows'=>6, 'cols'=>50, 'placeholder'=>'Nhập nội dung'));?>
				
				<div class="action_container">

					<?php 
		
					$this->widget('bootstrap.widgets.TbButton',array(
						'label' => 'Gửi',
						'type' => 'primary',
						'url' => Yii::app()->createUrl('threads/editThread', array('thread_id' => $model->thread_id, 'userid' => $user_id)),
						'size' => 'small',
						'buttonType' => 'ajaxSubmit',
						'ajaxOptions' => array(
					            'type' => 'POST',
					            'success' => 'function(data) {
										$model = $.parseJSON(data);
										$("#submitEditButton").parents(".thread_block").find(".post_entry_content").html($model.thread_content);
										closeEditor($("#submitEditButton"));
								}',
								'error' => 'function(err) {}',
					            'processData' => false,
					    ),
						'htmlOptions' => array(
							'id'=>'submitEditButton',
						),
				));
		
				?>
				<?php 
		
					$this->widget('bootstrap.widgets.TbButton',array(
						'label' => 'Hủy',
						'size' => 'small',
						'buttonType' => 'reset',
						'htmlOptions' => array(
								'onclick'=>'closeEditor(this)',
						),
				));
		
				?>
		
				</div>
				
				
				
				<?php $this->endWidget(); 
				}?>
			
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
			
			<?php 
				
				if($user_id == $model->user_id) { ?>
			
			<div class="button">
			
				<a href="javascript:;" onclick="showEditor(this);">Sửa</a>
			
			</div>
			
				<?php }?>

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
