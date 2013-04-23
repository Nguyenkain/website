<?php

/**
 * This is the model base class for the table "posts".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Posts".
 *
 * Columns in table "posts" available as properties of the model,
 * followed by relations of table "posts" available as properties of the model.
 *
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $thread_id
 * @property string $post_content
 * @property integer $post_created_time
 *
 * @property Users $user
 */
abstract class BasePosts extends GxActiveRecord {

	public $user_search;
	public $thread_search;
	public $temp;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'posts';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Bài viết|Bài viết', $n);
	}

	public static function representingColumn() {
		return 'post_content';
	}

	public function rules() {
		return array(
				array('user_id, thread_id, post_content, post_created_time', 'required',
						'message'=>'Hãy vui lòng nhập giá trị cho {attribute}.'),
				array('user_id, thread_id, post_created_time', 'numerical', 'integerOnly'=>true),
				array('post_id, user_id, thread_id, post_content, post_created_time, thread_search, user_search', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
				'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
				'threads' => array(self::BELONGS_TO, 'Threads', 'thread_id'),
		);
	}
	
	function defaultScope()
	{
		return array(
				'alias' => $this->tableName()
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
				'post_id' => Yii::t('app', 'Bài viết'),
				'user_id' => Yii::t('app', 'Người viết'),
				'thread_id' => Yii::t('app', 'Chủ đề'),
				'post_content' => Yii::t('app', 'Nội dung'),
				'post_created_time' => Yii::t('app', 'Ngày tạo'),
				'users' => null,
				'threads' => null,
		);
	}

 protected function beforeFind() {
    $criteria = new CDbCriteria;
    if (isset($temp))
    	$criteria->condition = "post_created_time <= 86400+".$temp;

    $this->dbCriteria->mergeWith($criteria);
    parent::beforeFind();
  }
  
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('name',$this->user_search, true);
		$criteria->with = 'users';
		
		$criteria->compare('threads.thread_title',$this->thread_search, true);
		$criteria->with = 'threads';

		$temp = strtotime($this->post_created_time);
		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('thread_id', $this->thread_id);
		$criteria->compare('post_content', $this->post_content, true);
		$criteria->compare('post_created_time', '<='.strtotime($this->post_created_time), false);

		/* return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)); */

		return new CActiveDataProvider( 'Posts', array(
				'criteria'=>$criteria,
				'sort'=>array(
						'attributes'=>array(
								'user_search'=>array(
										'asc'=>'name',
										'desc'=>'name DESC',
								),
								'thread_search'=>array(
										'asc'=>'threads.thread_title',
										'desc'=>'threads.thread_title DESC',
								),
								'*',
						),
				),
		));
	}
}