<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->post_id,
);

$this->menu=array(
	array('label'=>'List Posts','url'=>array('index')),
	array('label'=>'Create Posts','url'=>array('create')),
	array('label'=>'Update Posts','url'=>array('update','id'=>$model->post_id)),
	array('label'=>'Delete Posts','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Posts','url'=>array('admin')),
);
?>

<h1>View Posts #<?php echo $model->post_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
		'user_id',
		'thread_id',
		'post_content',
        array('name'=>'post_created_time',
        'value'=>date("d/m/y H:i:s", $model->post_created_time)),
	),
)); ?>
