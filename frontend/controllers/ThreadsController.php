<?php

class ThreadsController extends Controller
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
						'actions'=>array('index','view','post','getNotification','report','postToFacebook','newPost','login','setNotification','delete','editThread','editPost','deletePost'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','relational','reports', 'reportsView', 'unreport'),
						'users'=>array('*'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin'),
						'users'=>array('*'),
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
		$images = Thread_images::model()->findAllByAttributes(array('thread_id' => $thread->thread_id));
		$model->thread_search = $thread->thread_title;
		$dataProvider=new CActiveDataProvider('Posts');
		$newPost = new Posts;
		$success = false;

		//Check Facebook Login

		$userid = Yii::app()->facebook->getUser();
		if ($userid)
		{
			try
			{
				$record = Users::model()->findByAttributes(array('facebook_id'=>$userid));
				$user_info	= Yii::app()->facebook->getInfo();
				$url = Yii::app()->facebook->getLogoutUrl();
				if($record!=null) {
					Yii::app()->session['userid'] = $record->user_id;
				}
			}
			catch(FacebookApiException $e){
				$userid = NULL;
				unset(Yii::app()->session['userid']);
				Yii::app()->facebook->destroySession();
			}
		}

		//END CHECK

		if(isset($_GET['success']))
		{
			$success = $_GET['success'];
		}
		if($success) {
			$this->widget('application.extensions.PNotify.PNotify',array(
					'options'=>array(
							'title'=>'Thành công!',
							'text'=>'Thông báo của bạn đã được gửi tới admin và sẽ được chúng tôi xử lý trong thời gian sớm nhất!',
							'type'=>'success',
							'closer'=>true,
							'hide'=>true,))
			);
		}

		$this->render('view',array(
				'dataProvider'=>$dataProvider,
				'post_model'=>$model,
				'model' => $thread,
				'thread_title'=>$thread->thread_title,
				'newPost' => $newPost,
				'userid' => $userid,
				'images' => $images,
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Threads']))
		{
			$model->attributes=$_POST['Threads'];
			$transaction = Yii::app( )->db->beginTransaction( );
			try {
				if($model->save())
					$this->redirect(array('view','id'=>$model->thread_id));
			} catch(Exception $e) {
				$transaction->rollback( );
				Yii::app( )->handleException( $e );
			}
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$userid = Yii::app()->facebook->getUser();

		if ($userid)
		{
			try
			{
				$record = Users::model()->findByAttributes(array('facebook_id'=>$userid));
				$user_info	= Yii::app()->facebook->getInfo();
				$url = Yii::app()->facebook->getLogoutUrl();
				if($record!=null) {
					Yii::app()->session['userid'] = $record->user_id;
				}
			}
			catch(FacebookApiException $e){
				$userid = NULL;
				unset(Yii::app()->session['userid']);
				Yii::app()->facebook->destroySession();
			}
		}

		$criteria = new CDbCriteria;

		$criteria->select = array(
				'*',
				'count(*) as posts_count',
		);
		$criteria->group = 'thread_id';

		$dataProvider=new CActiveDataProvider('Threads',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>6,
				),
				'sort'=>array(
						'defaultOrder'=>'last_posted_time DESC',
				)
		)
		);
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

	public function actionGetNotification()
	{
		$user_id = $_POST['facebook_id'];
		$user = Users::model()->findByAttributes(array('facebook_id'=> $user_id));
		$criteria = new CDbCriteria();
		$criteria->join='Join threads ON t.thread_id=threads.thread_id';
		$criteria->group = 'viewed_status,thread_id';
		$criteria->compare('t.user_id', $user->user_id, true);
		$criteria->order = 'viewed_status, last_posted_time';
		$model = Notifications::model()->findAll($criteria);

		for ($i = 0; $i != sizeof($model); $i++){
			$model[$i] = $model[$i]->toJSON(); //I use the EJsonBehavior.php!
		}

		$model = CJavaScript::jsonEncode($model);
		echo $model;
	}

	public function actionSetNotification()
	{
		$user_id = $_POST['facebook_id'];
		$thread_id = $_POST['thread_id'];
		$user = Users::model()->findByAttributes(array('facebook_id'=> $user_id));
		$noti = Notifications::model()->findByAttributes(array('user_id'=>$user->user_id,'thread_id'=>$thread_id,'viewed_status'=> 0));
		if($noti === null) {
			echo 'no notification';
		}
		else {
			if($noti->saveAttributes(array('viewed_status' => 1))) {
				echo 'success';
			}
			else {
				echo 'failed';
			}
		}
	}

	public function actionPost()
	{
		//EQuickDlgs::render('_post',array());
		$fbId = Yii::app()->request->getQuery("id");
		//EQuickDlgs::checkDialogJsScript();
		$criteria = new CDbCriteria();
		$criteria->compare('facebook_id', $fbId, true);
		$data = Users::model()->find($criteria);

		$model = new Threads;
		$model->user_id = $data->user_id;
		$this->performAjaxValidation($model);
		$flag=true;

		if(isset($_POST['Threads']))
		{
			$flag=false;
			$transaction = Yii::app( )->db->beginTransaction( );
			try {
				$model->attributes=$_POST['Threads'];
				$model->thread_created_time = time();
				$model->last_posted_time = time();
				$valid=$model->validate();
				if($valid) {
					if($model->save())
					{
						echo CJSON::encode(array(
								'status'=>'success'
						));
					}

					Yii::app()->end();
				}
				else{
					$error = CActiveForm::validate($model);
					if($error!='[]')
						echo $error;
					Yii::app()->end();
				}
			} catch(Exception $e) {
				$transaction->rollback( );
				Yii::app( )->handleException( $e );
			}
		}
		if($flag) {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			//EQuickDlgs::render('post', array("model" => $model, "data" => $data));
			$this->renderPartial('dialog', array("model" => $model, "data" => $data),false,true);
		}
	}

	public function actionNewPost() {
		if(isset($_POST['Posts']))
		{
			$model = new Posts;
			$this->performAjaxValidation($model);
			$model->attributes=$_POST['Posts'];
			$thread_id = Yii::app()->request->getQuery("thread_id");
			$fbid = Yii::app()->request->getQuery("fbid");
			$criteria = new CDbCriteria();
			$criteria->compare('facebook_id', $fbid, true);
			$data = Users::model()->find($criteria);
			$model->thread_id = $thread_id;
			$model->user_id = $data->user_id;
			$model->post_created_time = time();
			$valid=$model->validate();
			if($valid) {
				if($model->save())
					echo 'success';
				else
					echo 'error';
			}
			else {
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo $error;
				Yii::app()->end();
			}
		}

	}

	public function actionEditThread() {
		if(isset($_POST['Threads']))
		{
			$model = new Threads;
			$this->performAjaxValidation($model);
			$thread_id = Yii::app()->request->getQuery("thread_id");
			$thread = $this->loadModel($thread_id);
			$model = $thread;
			$model->attributes=$_POST['Threads'];
			$valid=$model->validate();
			if($valid) {
				if($thread->saveAttributes(array('thread_content'=>$model->thread_content,'last_modified_time'=>time()))) {
					echo $thread->toJSON();
				}
				else
					echo 'failed';
			}
			else {
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo $error;
				Yii::app()->end();
			}
		}

	}

	public function actionEditPost() {
		if(isset($_POST['Posts']))
		{
			$post_id = $_POST['Posts']['post_id'];
			$model = new Posts;
			$this->performAjaxValidation($model);
			$model->attributes=$_POST['Posts'];
			$post = Posts::model()->findByPk($post_id);
			$model->post_created_time = $post->post_created_time;
			$model->thread_id = $post->thread_id;
			$valid=$model->validate();
			if($valid) {
				if($post->saveAttributes(array('post_content'=>$model->post_content))) {
					echo $post->toJSON();
				}
				else
					echo 'failed';
			}
			else {
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo $error;
				Yii::app()->end();
			}
		}

	}


	public function actionReport()
	{
		//EQuickDlgs::render('_post',array());
		$fbId = Yii::app()->request->getQuery("user_id");
		$threadId = Yii::app()->request->getQuery("thread_id");

		$criteria = new CDbCriteria();
		$criteria->compare('facebook_id', $fbId, true);
		$data = Users::model()->find($criteria);

		$model = new Reports;
		$model->user_id = $data->user_id;
		$model->thread_id = $threadId;

		if(isset($_POST['Reports']))
		{
			$model->attributes=$_POST['Reports'];
			if($model->save())
				EQuickDlgs::checkDialogJsScript();

			$this->redirect(array('view','id'=>$model->thread_id,'success'=>true));
		}

		$this->renderPartial('report', array("model" => $model, "data" => $data));
	}

	public function actionDelete()
	{
		//EQuickDlgs::render('_post',array());
		$userid = $_POST['userid'];
		$threadId = Yii::app()->request->getQuery("thread_id");

		$data = Users::model()->findByPk($userid);

		$reportTypes = ReportTypes::model()->findByAttributes(array('report_type' => 'Xóa'));
		$posts = Posts::model()->findAllByAttributes(array('thread_id' => $threadId));

		if(count($posts) > 0)
		{
			$model = new Reports;
			$model->user_id = $data->user_id;
			$model->thread_id = $threadId;
			$model->report_type_id = $reportTypes->report_type_id;
			$model->comment = "Người viết yêu cầu xóa";
			if($model->save())
			{
				echo 'reported';
			}
		}
		else
		{
			if($this->loadModel($threadId)->delete())
			{
				echo 'deleted';
			}
		}


	}

	public function actionDeletePost()
	{
		//EQuickDlgs::render('_post',array());
		$postId = $_POST['post_id'];

		if(Posts::model()->findByPk($postId)->delete())
		{
			$this->widget('application.extensions.PNotify.PNotify',array(
					'options'=>array(
							'title'=>'Thành công!',
							'text'=>'Bạn đã xóa thành công bài viết của bạn',
							'type'=>'success',
							'closer'=>true,
							'hide'=>true))
			);
			echo 'success';
		}


	}

	public function actionLogin() {
		$facebookID = Yii::app()->facebook->getUser();
		$accessToken = Yii::app()->facebook->getAccessToken();
		$loginUrl = Yii::app()->facebook->getLoginUrl(array(
				'scope'	=> 'read_stream, publish_stream, user_birthday, user_location, email, user_hometown, user_photos',
		));

		if($facebookID == 0 || $facebookID == "") {
			echo '<script>
					window.location="'.$loginUrl.'"
							</script>';

		} else {
			$record = Users::model()->findByAttributes(array('facebook_id'=>$facebookID));

			if($record===null) {
				try
				{
					$userInfo = Yii::app()->facebook->api('/me');

					$model = new Users;
					$model->facebook_id = $userid;
					$model->name = $user_info['name'];
					$model->username = $user_info['username'];
					$model->user_avatar = $userid;
					$model->user_email = $user_info['email'];
					$model->user_dob = $user_info['birthday'];
					if(isset($user_info['location']))
						$model->user_address = $user_info['location']['name'];
					if($model->save()) {
						$userid = $model->user_id;
						Yii::app()->session['userid'] = $userid;
					}
				}
				catch(FacebookApiException $e){
					$facebookID = NULL;
				}
			}


			echo "<script>
					window.close();
					window.opener.location.reload();
					</script>";
		}
	}

	public function actionPostToFacebook()
	{
		$fbId = $_POST['facebook_id'];
		$threadId = $_POST['thread_id'];
		$thread = $this->loadModel($threadId);
		$user = $thread->users;
		try{
			$publishStream = Yii::app()->facebook->api("/$fbId/feed", 'post', array(
					'message'		=> 'Từ bài viết '.$thread->thread_title.' của '.$user->name,
					'link'			=> 'http://vncreatures.net',
					'picture'		=> 'https://raw.github.com/fbsamples/ios-3.x-howtos/master/Images/iossdk_logo.png',
					'name'			=> 'VnCreatures',
					'caption'		=> 'Từ bài viết '.$thread->thread_title.' của '.$user->name,
					'description'	=> $thread->thread_content,
			));
		}catch(FacebookApiException $e){
			error_log($e);
			echo 'error';
		}
		$this->widget('application.extensions.PNotify.PNotify',array(
				'options'=>array(
						'title'=>'Thành công!',
						'text'=>'Bài viết của bạn đã được đăng trên facebook!',
						'type'=>'success',
						'closer'=>true,
						'hide'=>true))
		);
		echo 'success';
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
