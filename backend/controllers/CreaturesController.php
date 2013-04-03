<?php

class CreaturesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout_creatures';

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
				array('allow', // allow authenticated user to perform 'create' and 'update' actions),
						'actions'=>array('create','update','dynamiccreate','dynamicloai','dynamicnhom','dynamicbo','dynamicauthor'),
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
		$model=$this->loadModel($id);
		$coordinations=$model->rProvince;
		
		$this->render('view',array(
				'model'=>$model,
				'coordinations'=>$coordinations,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Creatures;
		
		Yii::import( "xupload.models.XUploadForm" );
		$photos = new XUploadForm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creatures'])){
			$model->attributes=$_POST['Creatures'];
			if(isset($_POST['Coordinations'])){
				$model->rProvince = $_POST['Coordinations']['province_id'];
			}
			$transaction = Yii::app( )->db->beginTransaction( );
			try {
				//Save the model to the database
				if($model->save()){
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->ID));
				}
			} catch(Exception $e) {
				$transaction->rollback( );
				Yii::app( )->handleException( $e );
			}
		}

		$this->render('create',array(
				'model'=>$model,
				'coordinations'=>Coordinations::model(),
				'photo'=>$photos,
		));
	}
	
	public function actionChange() {
		$id = Yii::app()->request->getQuery("id");
		$name = Yii::app()->request->getQuery("name");
		$model = $this->loadModel($id);
		$url ="";
		if($model->Loai == 1) {
			$url = 'animal';
		}
		else if($model->Loai == 2) {
			$url = 'plant';
		}
		else if($model->Loai == 3) {
			$url = 'insect';
		}
		$path = Yii::app( )->getBasePath( )."/../frontend/www/images/pictures/$url/";
		$publicPath = Yii::app( )->getBaseUrl( )."/../web/images/pictures/$url/";
		$file = CUploadedFile::getInstanceByName('file');
		// Do your business ... save on file system for example,
		// and/or do some db operations for example
		$fileOld = $path.$name.'s.jpg';
		if(is_file($fileOld)) {
			unlink($fileOld);
		}
		$file->saveAs($path.$name.'s.jpg');
		// return the new file path
		echo $publicPath.$name.'s.jpg';
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
							'ext' => $model->file->getExtensionName(),
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
	
	public function actionUpload2()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$folder='upload/';// folder for uploaded files
		$allowedExtensions = array("jpg","png");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		echo $result;// it's array
	}
	public function actionDynamiccreate()
	{
		$ho = Ho::model()->findByPk((int) $_POST['Ho']);
		$data = Bo::model()->findAll('ID=:parent_id',
				array(':parent_id'=>(int) $ho->Bo));

		$data2 = Nhom::model()->findAll('ID=:parent_id',
				array(':parent_id'=>(int)$data[0]->Nhom));
		$data3 = Loai::model()->findAll('ID=:parent_id',
				array(':parent_id'=>(int)$data2[0]->Loai));


		$data = CHtml::listData($data,'ID','Viet');
		$data2 = CHtml::listData($data2,'ID','Viet');
		$data3 = CHtml::listData($data3,'ID','Loai');
		$Bo='';
		$Nhom='';
		$Loai='';
		foreach($data as $ID => $value)

			$Bo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);


		foreach($data2 as $ID => $value)

			$Nhom.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		foreach($data3 as $ID => $value)

			$Loai.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);

		echo CJSON::encode(array(
				'dropdownBo'=>$Bo,
				'dropdownNhom'=>$Nhom,
				'dropdownLoai'=>$Loai,
		));
	}
	
	public function actionDynamicloai()
	{
		$loai = Loai::model()->findByPk((int) $_POST['ID']);	
		$nhom = Nhom::model()->findAll('Loai=:parent_id',
				array(':parent_id'=>(int) $loai->ID));
		$bo = Bo::model()->findAll('Nhom=:parent_id',
				array(':parent_id'=>(int)$nhom[0]->ID));
		$ho = Ho::model()->findAll('Bo=:parent_id',
				array(':parent_id'=>(int)$bo[0]->ID));

		$nhom = CHtml::listData($nhom,'ID','Viet');
		$bo = CHtml::listData($bo,'ID','Viet');
		$ho = CHtml::listData($ho,'ID','Viet');
		
		$listNhom='';
		$listBo='';
		$listHo='';
		
		foreach($nhom as $ID => $value)
		{

				$listNhom.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}
		foreach($bo as $ID => $value)
		{

				$listBo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}
		foreach($ho as $ID => $value)
		{

				$listHo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}

		echo CJSON::encode(array(
				'dropdownNhom'=>$listNhom,
				'dropdownBo'=>$listBo,
				'dropdownHo'=>$listHo,
		));
	}
	
	public function actionDynamicnhom()
	{
		$nhom = Nhom::model()->findByPk((int) $_POST['ID']);	
		$bo = Bo::model()->findAll('Nhom=:parent_id',
				array(':parent_id'=>(int)$nhom->ID));
		$ho = Ho::model()->findAll('Bo=:parent_id',
				array(':parent_id'=>(int)$bo[0]->ID));

		$bo = CHtml::listData($bo,'ID','Viet');
		$ho = CHtml::listData($ho,'ID','Viet');
		
		$listBo='';
		$listHo='';
		
		foreach($bo as $ID => $value)
		{

				$listBo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}
		foreach($ho as $ID => $value)
		{

				$listHo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}

		echo CJSON::encode(array(
				'dropdownBo'=>$listBo,
				'dropdownHo'=>$listHo,
		));
	}
	
	public function actionDynamicbo()
	{
		$bo = Bo::model()->findByPk((int) $_POST['ID']);	
		$ho = Ho::model()->findAll('Bo=:parent_id',
				array(':parent_id'=>(int)$bo->ID));

		$ho = CHtml::listData($ho,'ID','Viet');
		
		$listHo='';
		
		foreach($ho as $ID => $value)
		{

				$listHo.= CHtml::tag('option',array('value' => $ID),CHtml::encode($value),true);
		}

		echo CJSON::encode(array(
				'dropdownHo'=>$listHo,
		));
	}
	
	public function actionCreatdataforLoai($data,$row)
	{

		return  CHtml::encode($data->name) ;
	}

	public function actionDynamicauthor()
	{
		$data=Author::model()->findAll('ID=:parent_id',
				array(':parent_id'=>(int) $_POST['Author']));

		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					array('value'=>$value),CHtml::encode($name),true);
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
		$coordinations=$model->rProvince;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creatures'])){
			$model->attributes=$_POST['Creatures'];
			if(isset($_POST['Coordinations'])){
				$model->rProvince = $_POST['Coordinations']['province_id'];
			}else {
				$model->rProvince = null;
			}
			$valid=$model->save();
			if($valid){
				$this->redirect(array('view','id'=>$model->ID));
			}
		}

		$this->render('update',array(
				'model'=>$model,'coordinations'=>$coordinations,
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
			$transaction=Yii::app()->db->beginTransaction();
			try
			{
				$model = $this->loadModel($id);
				foreach( $model->rRelation as $relation ) {
					if( $relation == null){
						continue;
					}
					else {
						$relation->delete();
					}
				}
				$model->delete();
				$transaction->commit();
			}
			catch(Exception $e)
			{
				$transaction->rollback();
			}

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Creatures');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Creatures('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Creatures']))
			$model->attributes=$_GET['Creatures'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Creatures::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='creatures-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
