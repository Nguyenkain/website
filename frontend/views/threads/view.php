<?php 
function checkUrl($url) {
	@$headers = get_headers($url);
	if (preg_match('/^HTTP\/\d\.\d\s+(200|301|302)/', $headers[0])){
		return true;
	}
	else return false;
}

$assetUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.PNotify.assets'));
Yii::app()->clientScript->registerScriptFile($assetUrl.'/js/jquery.pnotify.min.js');
Yii::app()->clientScript->registerCssFile($assetUrl.'/js/jquery.pnotify.default.css');
?>

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
	    	  	if(typeof $model.post_content != "undefined") {
					$(btn).parents(".thread_block").find(".post_entry_content").html($model.post_content);
					closeEditor(btn);
	    	  	}
	    	  	else {
	    	  		$.each($model, function(key, val) {
                        form.find("#"+key+"_em_").text(val);                                                    
                        form.find("#"+key+"_em_").show();
                    });
	    	  	}
	      },
	      error: function(xhr){
		      debugger;
	      }
	    });
}

function deletePost(btn)
{
	bootbox.confirm("Bạn có chắc chắn muốn xóa bài viết này?",
			function(confirmed){
		if(confirmed) {
			var form = $(btn).parents('.thread_block').find('form');
			var postid = $(form).find('.postid').val();
			
			$.ajax({
			      type: "POST",
			      url:   "<? echo Yii::app()->createUrl('threads/deletePost'); ?>",
			      data:  {'post_id':postid},
			      success: function(data){
			    	  	if(data == 'success') {
			    	  		$.pnotify({
			    			    title: 'Thành công',
			    			    text: 'Bạn đã xóa thành công bài viết của bạn!',
			    			    type: 'success',
			    			    closer: true,
			    			    hide: true,
			    			    nonblock: true,
			    			    nonblock_opacity: .2
			    			});
			    	  		$.fn.yiiListView.update("post_listview");
			    	  	}
			      },
			      error: function(xhr){
			      }
			    });
		}
	});
}

function deleteThread(btn,userid)
{
	bootbox.confirm("Bạn có chắc chắn muốn xóa chủ đề này?",
			function(confirmed){
		if(confirmed) {
			$.ajax({
			      type: "POST",
			      url:   "<? echo Yii::app()->createUrl('threads/delete',array('thread_id'=>$model->thread_id)); ?>",
			      data:  {'userid':userid},
			      success: function(data){
			    	  	if(data == 'deleted') {
			    	  		window.location = "<? echo Yii::app()->createUrl('threads/index') ?>";
			    	  		$.pnotify({
			    			    title: 'Thành công',
			    			    text: 'Bạn đã xóa thành công bài viết của bạn!',
			    			    type: 'success',
			    			    closer: true,
			    			    hide: true,
			    			    nonblock: true,
			    			    nonblock_opacity: .2
			    			});
			    	  	}
			    	  	if(data == 'reported') {
			    	  		$.pnotify({
			    			    title: 'Thành công',
			    			    text: 'Thông báo xóa của bạn đã được gửi đến admin và sẽ được xử lý trong thời gian sớm nhất!',
			    			    type: 'success',
			    			    closer: true,
			    			    hide: true,
			    			    nonblock: true,
			    			    nonblock_opacity: .2
			    			});
			    	  	}
			      },
			      error: function(xhr){
			      }
			    });
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
{
	$user_id = Yii::app()->session['userid'];
	$ban = Users::model()->findByPk($user_id)->ban_status;
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
			<div class="post_entry_image">
				<?php foreach ($images as $image)
				{
					$link = Yii::app()->request->getBaseUrl(true).$image->image_link;
					if(checkUrl($link))
						?>
				<a class="image_thread" href="<?php echo $link?>"> <?php 
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
				jqPrettyPhoto::addPretty('.post_entry_image a.image_thread',jqPrettyPhoto::PRETTY_GALLERY,jqPrettyPhoto::THEME_FACEBOOK, $options);

				?>
			</div>
			<div class="post_edit_content" style="display: none">
				<?php if($userid && ($user_id==$model->user_id) && $ban == 0) 
				{
					?>
				<?php  $form = $this -> beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'thread_edit_form',
						'type' => 'horizontal',
						'enableAjaxValidation'=>true,
				));
				?>

				<?php echo $form->textArea($model,'thread_content',array('rows'=>6, 'cols'=>50, 'placeholder'=>'Nhập nội dung'));
				echo $form->error($model,'thread_content');
				?>

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
										if(typeof $model.thread_content != "undefined") {
											$("#submitEditButton").parents(".thread_block").find(".post_entry_content").html($model.thread_content);
											closeEditor($("#submitEditButton"));
										}
										else {
							    	  		$.each($model, function(key, val) {
						                        $("#submitEditButton").parents(".thread_block").find("#"+key+"_em_").text(val);                                                    
						                        $("#submitEditButton").parents(".thread_block").find("#"+key+"_em_").show();
						                    });
							    	  	}
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

				if($user_id == $model->user_id && $ban == 0) {
					echo CHtml::link("Xóa","javascript:;", array("onclick"=>"deleteThread(this,'$user_id')"));
					/* EQuickDlgs::ajaxLink(
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
					); */
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

				if($user_id == $model->user_id && $ban == 0) { ?>

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
			$("#thread_detail_container").removeClass("hasLoading");
			$(".comment_editor textarea").val("");
}',
			'beforeAjaxUpdate' => 'js:function(id) {
			$("#thread_detail_container").addClass("hasLoading");
			$("#submitButton").attr("disabled","disabled");
}',
	))?>

</div>

<?php 
if($userid) {

?>

<div class="comment_container">

	<?php  $form = $this -> beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'user-comment-form',
			'enableClientValidation'=>true,
			'type' => 'horizontal',
	));
	?>

	<h3 class="comment_title">Trả lời</h3>

	<div class="comment_box">

		<div class="comment_editor">

			<?php echo $form->textArea($newPost,'post_content',array('rows'=>6, 'cols'=>50, 'placeholder'=>'Nhập nội dung trả lời'));
			echo $form->error($newPost,'post_content');
			?>

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
							$model = $.parseJSON(data);
				    	  	if(typeof $model.status == "undefined") {
									$.each($model, function(key, val) {
				                        $("#user-comment-form").find("#"+key+"_em_").text(val);                                                    
				                        $("#user-comment-form").find("#"+key+"_em_").show();
				                    });
				    	  	}
							else
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
