<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','upload'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
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
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/* public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$folder='upload/';// folder for uploaded files
		$allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		echo $result;// it's array
	} */
	
	/**
	 * Handles resource upload
	 * @throws CHttpException
	 */
	public function actionUpload()
	{
		header('Vary: Accept');
		if (isset($_SERVER['HTTP_ACCEPT']) &&
		(strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
		{
			header('Content-type: application/json');
		} else {
			header('Content-type: text/plain');
		}
		$data = array();
	
		$model = new News('upload');
		$model->picture = CUploadedFile::getInstance($model, 'picture');
		if ($model->picture !== null  && $model->validate(array('picture')))
		{
			$model->picture->saveAs(
					Yii::getPathOfAlias('frontend.www.files').'/'.$model->picture->name);
			$model->file_name = $model->picture->name;
			// save picture name
			if( $model->save())
			{
				// return data to the fileuploader
				$data[] = array(
						'name' => $model->picture->name,
						'type' => $model->picture->type,
						'size' => $model->picture->size,
						// we need to return the place where our image has been saved
						//'url' => $model->getImageUrl(), // Should we add a helper method?
						// we need to provide a thumbnail url to display on the list
						// after upload. Again, the helper method now getting thumbnail.
						//'thumbnail_url' => $model->getImageUrl(News::IMG_THUMBNAIL),
						// we need to include the action that is going to delete the picture
						// if we want to after loading
						'delete_url' => $this->createUrl('news/delete',
								array('id' => $model->id, 'method' => 'uploader')),
						'delete_type' => 'POST');
			} else {
				$data[] = array('error' => 'Unable to save model after saving picture');
			}
		} else {
			if ($model->hasErrors('picture'))
			{
				$data[] = array('error', $model->getErrors('picture'));
			} else {
				throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
			}
		}
		// JQuery File Upload expects JSON data
		echo json_encode($data);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->news_id));
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->news_id));
		}

		$this->render('update',array(
				'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
