<?php

/**
 * This is the model base class for the table "threads".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Threads".
 *
 * Columns in table "threads" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $thread_id
 * @property integer $last_modified_time
 * @property integer $user_id
 * @property string $thread_title
 * @property string $thread_content
 * @property integer $thread_created_time
 * @property integer $last_posted_time
 *
 */
abstract class BaseThreads extends GxActiveRecord {

	public $user_search;	
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'threads';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Chủ đề|Chủ đề', $n);
	}

	public static function representingColumn() {
		return 'thread_title';
	}

	public function rules() {
		return array(
			array('user_id, thread_title, thread_content, thread_created_time, last_posted_time', 'required',
						'message'=>'Hãy vui lòng nhập giá trị cho {attribute}.'),
			array('last_modified_time, user_id, thread_created_time, last_posted_time', 'numerical', 'integerOnly'=>true),
			array('thread_title', 'length', 'max'=>150),
			array('last_modified_time', 'default', 'setOnEmpty' => true, 'value' => null),
			array('thread_id, last_modified_time, user_id, thread_title, thread_content, thread_created_time, last_posted_time, user_search', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'users' => array(self::HAS_ONE, 'Users', array('user_id'=>'user_id'), 'joinType'=>'INNER JOIN'),
			'posts' => array(self::HAS_MANY, 'Posts', 'thread_id'),
			'report' => array(self::HAS_MANY, 'Reports', 'thread_id'),
			'notification' => array(self::HAS_MANY, 'Notifications', 'thread_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'thread_id' => Yii::t('app', 'Chủ đề'),
			'last_modified_time' => Yii::t('app', 'Ngày sửa cuối'),
			'user_id' => Yii::t('app', 'Người viết'),
			'thread_title' => Yii::t('app', 'Tiêu đề'),
			'thread_content' => Yii::t('app', 'Nội dung'),
			'thread_created_time' => Yii::t('app', 'Ngày tạo'),
			'last_posted_time' => Yii::t('app', 'Bài viết cuối'),
			'report' => null,
		);
	}
	
	function defaultScope()
	{
		return array(
				'alias' => $this->tableName()
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		
		$criteria->compare('users.name',$this->user_search, true);
		$criteria->with = 'users';

		$criteria->compare('thread_id', $this->thread_id);
		$criteria->compare('last_modified_time', $this->last_modified_time);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('thread_title', $this->thread_title, true);
		$criteria->compare('thread_content', $this->thread_content, true);
		$criteria->compare('thread_created_time', '<='.strtotime($this->thread_created_time), false);
		$criteria->compare('last_posted_time', $this->last_posted_time);

		/* return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)); */
		
		return new CActiveDataProvider( 'Threads', array(
				'criteria'=>$criteria,
				'sort'=>array(
						'attributes'=>array(
								'user_search'=>array(
										'asc'=>'users.name',
										'desc'=>'users.name DESC',
								),
								'*',
						),
				),
		));
	}
}