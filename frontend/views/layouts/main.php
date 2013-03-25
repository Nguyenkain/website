<?php
/**
 * main.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:31 AM
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?= Yii::app()->charset ?>" />
<meta name="language" content="en" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/normalize.css">

<title><?php echo h($this->pageTitle); /* using shortcut for CHtml::encode */ ?>
</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">


<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />

<!--using less instead? file not included-->
<!--<link rel="stylesheet/less" type="text/css" href="/less/styles.less">-->

<!-- create your own: http://modernizr.com/download/-->
<script
	src="<?php echo Yii::app()->request->baseUrl; ?>/app/js/libs/utils/modernizr-2.6.2.js"></script>

<!--<script src="/less/less-1.3.0.min.js"></script>-->
<link rel="shortcut icon"
	href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
</head>

<body>
	<div id="wrapper">
		<div id="header">
			<div id="logo">
				<img alt="sinh vật rừng việt nam" src="css/images/logo.png">
				<h1 class="logo">Sinh vật rừng Việt Nam</h1>
			</div>
			<div class="clearfix"></div>
		</div>
		<div id="menu">
			<!-- <ul>
				<li><a href="#" accesskey="1" title="">Tìm Kiếm</a></li>
				<li><a href="#" accesskey="2" title="">Tin Tức</a></li>
				<li><a href="#" accesskey="3" title="">Bản Đồ</a></li>
				<li class="last"><a href="#" accesskey="4" title="">Thảo Luận</a></li>
			</ul> -->
		<?php $this->widget('zii.widgets.CMenu', array(
				'items'=>array(
					array('label'=>'Tìm Kiếm', 'url'=>array('/creatures/index') , 'active'=>$this->id=='creatures'?true:false),
					array('label'=>'Tin Tức', 'url'=>array('/news/index') , 'active'=>$this->id=='news'?true:false),
					array('label'=>'Bản Đồ', 'url'=>array('/creatures/admin') , 'active'=>$this->id=='creatures'?true:false ),
					array('label'=>'Thảo Luận', 'url'=>array('/creatures/admin') , 'itemOptions'=>array('class'=>'last') , 'active'=>$this->id=='creatures'?true:false),		
				),
			));
		?>
		</div>

		<!-- Display content and footer -->
		<?php echo $content?>
	</div>

	<!-- Google Analytics -->
	<script>
	var _gaq=[['_setAccount','<?php echo param('google.analytics.account'); // check global.php shortcut file at "common/lib/" ?>'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
</body>
</html>
