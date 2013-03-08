<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->category_id=>array('view','id'=>$model->category_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Create Categories', 'url'=>array('create')),
	array('label'=>'View Categories', 'url'=>array('view', 'id'=>$model->category_id)),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Update Categories <?php echo $model->category_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>