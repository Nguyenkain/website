<?php

class CreaturesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/layout_home';

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
						'actions'=>array('index','view','listcreatures'),
						'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','upload','dynamicbo','dynamicho','dynamicauthor'),
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
		if(isset($_GET['Creatures'])){
			$model->attributes=$_GET['Creatures'];
			$this->redirect(array('listcreatures',
					'Loai'=>$model->Loai,
					'Ho'=>$model->Ho,
					'Bo'=>$model->Bo,
					'Nhom'=>$model->Nhom,
					'Viet'=>$model->Viet,
					'Latin'=>$model->Viet));
		}
		$dataProvider=new CActiveDataProvider('Creatures');
		

		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}
	public function actionListcreatures($Loai,$Ho,$Bo,$Nhom,$Viet)
	{
		$model =  Creatures::model();
		$criteria = new CDbCriteria;
		
		$criteria->compare('Loai', $Loai, true);
		$criteria->compare('Ho', $Ho, true);
		$criteria->compare('Bo', $Bo, true);
		$criteria->compare('Nhom', $Nhom, true);
		$criteria->compare('Viet', $Viet, true);

		$dataProvider = new CActiveDataProvider('Creatures', array(
				'criteria'=>$criteria));
	
		if(isset($_GET['Creatures'])){
			
			$model->attributes=$_GET['Creatures'];
			$dataProvider= $model->search();
		}
		$this->render('listcreatures',array(
				'dataProvider'=>$dataProvider,
				'model'=>$model,
		));
		
	}
	public function actionViewDetail($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Creatures;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creatures']))
		{
			$model->attributes=$_POST['Creatures'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('create',array(
				'model'=>$model,
		));
	}
	public function actionUpload()
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
	public function actionDynamicbo()
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
				'dropdownLoai'=>$Loai
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Creatures']))
		{
			$model->attributes=$_POST['Creatures'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->ID));
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
		$model = new Creatures;

		$dataProvider=new CActiveDataProvider('Creatures');
		if(isset($_POST['Creatures']))
		{
			$model->attributes=$_POST['Creatures'];

			$this->redirect(array('listcreatures',
				'Loai'=>$model->Loai,
				'Ho'=>$model->Ho,
				'Bo'=>$model->Bo,
				'Nhom'=>$model->Nhom,
				'Viet'=>$model->Viet,
				'Latin'=>$model->Viet));
		}
		$this->render('index',array(
				'model'=> $model,
				'dataProvider'=>$dataProvider
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
