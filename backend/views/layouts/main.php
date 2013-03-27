<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?= Yii::app()->charset ?>" />
<meta name="language" content="en" />

<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
	media="screen, projection" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
	media="print" />
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/handle.js"></script>

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<?php $this->widget('bootstrap.widgets.TbNavbar',array(
			'type'=>'inverse', // null or 'inverse'
			'items'=>array(
					array(
							'class'=>'bootstrap.widgets.TbMenu',
							'items'=>array(
									array('label'=>'Sinh vật', 'url'=>array('/creatures/admin'), 'active'=>($this->id=='creatures' || $this->id=='ho' || $this->id=='bo' || $this->id=='nhom' || $this->id=='loai' || $this->id=='author')?true:false),
									array('label'=>'Tin tức', 'url'=>array('/news/admin'), 'active'=>($this->id=='news' || $this->id=='categories')?true:false),
									array('label'=>'Thảo luận', 'url'=>array('/threads/admin') , 'active'=>($this->id=='threads' || $this->id=='posts' || $this->id=='users' || $this->id=='report' || $this->id=='reportTypes')?true:false),
									array('label'=>'Vườn Quốc Gia', 'url'=>array('/nationalParks/admin'), 'active'=>$this->id=='nationalParks'?true:false),
									array('label'=>'Đăng nhập', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'active'=>$this->id=='site'?true:false),
									array('label'=>'Đăng xuất ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
							),
					),
			),

	));
	?>

	<div class="container" id="page">

		<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
		)); ?>
		<!-- breadcrumbs -->
		<?php endif?>

		<?php echo $content; ?>

		<div class="clear"></div>

		<div id="footer">
			Copyright &copy;
			<?php echo date('Y'); ?>
			by VnCreatures.<br /> All Rights Reserved.<br />
		</div>
		<!-- footer -->

	</div>
	<!-- page -->

</body>
</html>
