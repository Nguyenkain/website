<?php if(isset(Yii::app()->session['userid']))
	$user_id = Yii::app()->session['userid'];?>

<div class="thread_block">
	<div class="thread_date">
		<span><?php echo CHtml::encode(date("d/m/y H:i:s", $data->post_created_time)); ?></span>
	</div>
	<div class="author_block">
		<div class="user_avatar">
			<?php echo CHtml::image("http://graph.facebook.com/". $data->users->user_avatar ."/picture?type=normal"); ?>
		</div>
		<div class="user_name">
			<span><?php echo CHtml::encode($data->users); ?></span>
		</div>
	</div>
	<div class="post_body">
		<div class="post_entry_content">
			<?php echo CHtml::encode($data->post_content); ?>
		</div>
		
		<div class="post_edit_content" style="display:none">
			<?php if(isset($user_id) && ($user_id==$data->user_id)) 
			{
			?>
				<?php  $form = $this -> beginWidget('bootstrap.widgets.TbActiveForm', array(
						'id' => 'post_edit_form',
						'type' => 'horizontal',
						'action'=>Yii::app()->createUrl('threads/editPost'),
						'enableAjaxValidation'=>true,
				));
				?>
				
				<?php echo $form->textArea($data,'post_content',array('rows'=>6, 'cols'=>50, 'placeholder'=>'Nhập nội dung sửa'));
				echo $form->error($data,'post_content');
				echo $form->hiddenField($data,'user_id',array('class'=>'userid'));
				echo $form->hiddenField($data,'post_id',array('class'=>'postid'));
				?>
				
				<div class="action_container">

					<?php 
		
					$this->widget('bootstrap.widgets.TbButton',array(
						'label' => 'Gửi',
						'type' => 'primary',
						'size' => 'small',
						'htmlOptions' => array(
							'onclick'=>'editPost(this)',
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
		
		<?php if(isset($user_id) && ($user_id==$data->user_id)) 
			{
			?>
		<div class="button">
			<a href="javascript:;" onclick="showEditor(this);">Sửa</a>
		</div>
		<div class="button">
			<a href="javascript:;" onclick="deletePost(this);">Xóa</a>
		</div>
		<?php }?>
	</div>
</div>