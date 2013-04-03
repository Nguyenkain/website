<?php $this->breadcrumbs = array(
		'Vườn Quốc Gia' => array('admin'),
		'Tạo mới',
		);

	$this->menu = array(
		array('label' => 'Liệt kê Vườn Quốc Gia', 'url' => array('index')),
		array('label' => 'Quản lý Vườn Quốc Gia', 'url' => array('admin')),
		); ?>

<h3>Tạo mới Vườn Quốc Gia</h3>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>