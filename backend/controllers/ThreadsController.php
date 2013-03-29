<?php

class ThreadsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout_discussion';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
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
						'actions'=>array('index','view','upload'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','relational','reports', 'reportsView', 'unreport'),
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
		//$model=Posts::model()->findAllByAttributes(array('thread_id'=>$id));
		$model = Posts::model();
		$thread = $this->loadModel($id);
		$model->thread_search = $thread->thread_title;
		$dataProvider=new CActiveDataProvider('Posts');
		$this->render('view',array(
				'post_model'=>$model,
				'model' => $thread,
				'thread_title'=>$thread->thread_title,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Threads;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		if(isset($_POST['Threads']))
		{
			$model->attributes=$_POST['Threads'];
			
			$transaction = Yii::app( )->db->beginTransaction( );
			try {
				//Save the model to the database
				if($model->save()){
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->thread_id));
				}
			} catch(Exception $e) {
				$transaction->rollback( );
				Yii::app( )->handleException( $e );
			}
		}

		$this->render('create',array(
				'model'=>$model,
				'photo'=>$photos,
		));
	}
	
	public function actionUpload( ) {
		Yii::import( "xupload.models.XUploadForm" );
		//Here we define the paths where the files will be stored temporarily
		$path = realpath( Yii::app( )->getBasePath( )."/www/images/uploads/tmp/" )."/";
		$publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/tmp/";
	
		//This is for IE which doens't handle 'Content-type: application/json' correctly
		header( 'Vary: Accept' );
		if( isset( $_SERVER['HTTP_ACCEPT'] )
		&& (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
			header( 'Content-type: application/json' );
		} else {
			header( 'Content-type: text/plain' );
		}
	
		//Here we check if we are deleting and uploaded file
		if( isset( $_GET["_method"] ) ) {
			if( $_GET["_method"] == "delete" ) {
				if( $_GET["file"][0] !== '.' ) {
					$file = $path.$_GET["file"];
					if( is_file( $file ) ) {
						unlink( $file );
					}
				}
				echo json_encode( true );
			}
		} else {
			$model = new XUploadForm;
			$model->file = CUploadedFile::getInstance( $model, 'file' );
			//We check that the file was successfully uploaded
			if( $model->file !== null ) {
				//Grab some data
				$model->mime_type = $model->file->getType( );
				$model->size = $model->file->getSize( );
				$model->name = $model->file->getName( );
				//(optional) Generate a random name for our file
				$filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
				$filename .= ".".$model->file->getExtensionName( );
				if( $model->validate( ) ) {
					if( !is_dir( $path ) ) {
						mkdir( $path, 0777, true );
						chmod ( $path , 0777 );
					}
					//Move our file to our temporary dir
					$model->file->saveAs( $path.$filename );
					chmod( $path.$filename, 0777 );
					//here you can also generate the image versions you need
					//using something like PHPThumb
	
	
					//Now we need to save this path to the user's session
					if( Yii::app( )->user->hasState( 'images' ) ) {
						$userImages = Yii::app( )->user->getState( 'images' );
					} else {
						$userImages = array();
					}
					$userImages[] = array(
							"path" => $path.$filename,
							//the same file or a thumb version that you generated
							"thumb" => $path.$filename,
							"filename" => $filename,
							'size' => $model->size,
							'mime' => $model->mime_type,
							'name' => $model->name,
					);
					Yii::app( )->user->setState( 'images', $userImages );
	
					//Now we need to tell our widget that the upload was succesfull
					//We do so, using the json structure defined in
					// https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
					echo json_encode( array( array(
							"name" => $model->name,
							"type" => $model->mime_type,
							"size" => $model->size,
							"url" => $publicPath.$filename,
							"thumbnail_url" => $publicPath."$filename",
							"delete_url" => $this->createUrl( "upload", array(
									"_method" => "delete",
									"file" => $filename
							) ),
							"delete_type" => "POST"
					) ) );
				} else {
					//If the upload failed for some reason we log some data and let the widget know
					echo json_encode( array(
							array( "error" => $model->getErrors( 'file' ),
							) ) );
					Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
					CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
							);
				}
			} else {
				throw new CHttpException( 500, "Could not upload file" );
			}
		}
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

		if(isset($_POST['Threads']))
		{
			$model->attributes=$_POST['Threads'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->thread_id));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('reports'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$dataProvider=new CActiveDataProvider('Threads');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Threads('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Threads']))
			$model->attributes=$_GET['Threads'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	public function actionReports()
	{
		$model=new Threads('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Threads']))
			$model->attributes=$_GET['Threads'];

		$this->render('reports',array(
				'model'=>$model,
		));
	}

	public function actionReportsView($id)
	{
		$model = Reports::model();
		$thread = $this->loadModel($id);
		$model->thread_id = $thread->thread_id;
		// partially rendering "_relational" view
		$this->renderPartial('_reports', array(
				'model' => $model,
				'title' => $thread->thread_title,
		));
	}

	public function actionUnreport($id)
	{
		$criteria = new CDbCriteria(array(
				'condition' => 'thread_id=:parentId',
				'params' => array(
						':parentId' => $id),
		));

		$childrenReport = Reports::model()->findAll($criteria);

		foreach ($childrenReport as $child)
		{
			$child->delete();
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionRelational($id)
	{
		$model = Posts::model();
		$thread = $this->loadModel($id);
		$model->thread_search = $thread->thread_title;
		// partially rendering "_relational" view
		$this->renderPartial('_relational', array(
				'post_model' => $model->search(),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Threads::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='threads-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
