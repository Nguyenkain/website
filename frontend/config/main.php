<?php
/**
 * main.php
 *
 * This file holds frontend configuration settings.
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:48 PM
 */
$frontendConfigDir = dirname(__FILE__);

$root = $frontendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($frontendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'www');

$mainLocalFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $frontendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
	array(
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
		'basePath' => 'frontend',
		'name'=>'Sinh vật rừng Việt Nam',
		'defaultController' => 'creatures/index',
		// set parameters
		'params' => $params,
		// preload components required before running applications
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
		'preload' => array('bootstrap', 'log'),
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
		'language' => 'en',
		// uncomment if a theme is used
		/*'theme' => '',*/
		// setup import paths aliases
		// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
		'import' => array(
			'ext.quickdlgs.*',
			'common.components.*',
			'common.extensions.*',
			'common.extensions.giix-components.*',
			'common.models.*',
			// uncomment if behaviors are required
			// you can also import a specific one
			/* 'common.extensions.behaviors.*', */
			// uncomment if validators on common folder are required
			/* 'common.extensions.validators.*', */
			'application.components.*',
			'application.controllers.*',
			'application.models.*'
		),
		/* uncomment and set if required */
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
		/* 'modules' => array(), */
		'components' => array(
			'facebook'=>array(
					'class' => 'ext.yii-facebook-opengraph.SFacebook',
					'appId'=>'427633550638036', // needed for JS SDK, Social Plugins and PHP SDK
					'secret'=>'b97d24cecf84cf66f43fcab7ee4b2e62', // needed for the PHP SDK
					//'fileUpload'=>false, // needed to support API POST requests which send files
					//'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
					//'locale'=>'en_US', // override locale setting (defaults to en_US)
					//'jsSdk'=>true, // don't include JS SDK
					//'async'=>true, // load JS SDK asynchronously
					//'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
					//'status'=>true, // JS SDK - check login status
					//'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
					//'oauth'=>true,  // JS SDK - enable OAuth 2.0
					//'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
					//'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
					//'html5'=>true,  // use html5 Social Plugins instead of XFBML
					//'ogTags'=>array(  // set default OG tags
					//'title'=>'MY_WEBSITE_NAME',
					//'description'=>'MY_WEBSITE_DESCRIPTION',
					//'image'=>'URL_TO_WEBSITE_LOGO',
					//),
			),
			/* load bootstrap components */
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),
			'errorHandler' => array(
				// @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
				'errorAction'=>'site/error'
			),
			/* load bootstrap components */
			'bootstrap' => array(
					'class' => 'common.extensions.bootstrap.components.Bootstrap',
					'responsiveCss' => true,
			),
			'db' => array(
				'connectionString' => $params['db.connectionString'],
				'username' => $params['db.username'],
				'password' => $params['db.password'],
				'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
				'enableParamLogging' => YII_DEBUG,
				'charset' => 'latin1'
			),
// 			'urlManager' => array(
// 				'urlFormat' => 'path',
// 				'showScriptName' => false,
// 				'urlSuffix' => '/',
// 				'rules' => $params['url.rules']
// 			),
			/* make sure you have your cache set correctly before uncommenting */
			/* 'cache' => $params['cache.core'], */
			/* 'contentCache' => $params['cache.content'] */
		),
	),
	CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);