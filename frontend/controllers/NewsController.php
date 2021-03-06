<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout_normal';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','list'),
				'users'=>array('*'),
		),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout = '//layouts/layout_home';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$modelCategories = new Categories;
		$modelNews = new News;

		//$dataProviderCategories= new CActiveDataProvider($modelCategories);
		//$dataProviderNews= new CActiveDataProvider($modelNews);
		
		$this->render('index',array(
			'modelCategories'=>$modelCategories,
			'modelNews'=>$modelNews
		));

	}
	
	public function actionList()
	{
		$catId = Yii::app()->request->getQuery("cat_id");
		$category = Categories::model()->findByPk($catId);
		$criteria = new CDbCriteria;
		$criteria->compare('category_id', $catId, true);
		$criteria->order = "news_id DESC";
		$dataProvider = new CActiveDataProvider('News', array(
				'criteria'=>$criteria));
	
		$this->render('lists',array(
				'dataProvider' => $dataProvider,
				'title' => $category->category_name,
		));
	
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Categories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
		throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}
