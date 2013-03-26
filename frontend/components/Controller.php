<?php
/**
 * Controller.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:55 AM
 */
class Controller extends CController {

	public $breadcrumbs = array();
	public $menu = array();
	
	protected function afterRender($view, &$output) {
		parent::afterRender($view,$output);
		//Yii::app()->facebook->addJsCallback($js); // use this if you are registering any $js code you want to run asyc
		Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
		Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags
		return true;
	}

}
