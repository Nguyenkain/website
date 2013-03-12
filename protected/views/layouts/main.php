<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<?php $this->widget('bootstrap.widgets.TbNavbar',array(
			'type'=>'inverse', // null or 'inverse'
			'items'=>array(
					array(
							'class'=>'bootstrap.widgets.TbMenu',
							'items'=>array(
									array('label'=>'Sinh vật', 'url'=>array('/site/index')),
									array('label'=>'Tin tức', 'url'=>array('/news/admin')),
									array('label'=>'Thảo luận', 'url'=>array('/threads/admin')),
									array('label'=>'Vườn Quốc Gia', 'url'=>array('/nationalparks/admin')),
									array('label'=>'Đăng nhập', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
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
