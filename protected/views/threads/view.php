<?php
$this->breadcrumbs=array(
	'Quản trị chủ đề'=>array('admin'),
	$thread_title,
);
?>

<h1>Các bài viết trong bài <?php echo $thread_title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'posts-grid',
	'dataProvider'=>$post_model->search(),
	'filter'=>$post_model,
	'columns'=>array(
		'post_id',
		'user_id',
		'thread_id',
		'post_content',
		'post_created_time',
	),
)); ?>
