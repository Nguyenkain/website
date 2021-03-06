<?php

/**
 * This is the model base class for the table "users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Users".
 *
 * Columns in table "users" available as properties of the model,
 * followed by relations of table "users" available as properties of the model.
 *
 * @property integer $user_id
 * @property string $facebook_id
 * @property string $username
 * @property string $user_dob
 * @property string $user_address
 * @property string $user_email
 * @property integer $last_time_login
 * @property string $user_avatar
 * @property string $name
 * @property integer $ban_status
 *
 * @property Posts[] $posts
 * @property Reports[] $reports
 */
abstract class BaseUsers extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Users|Users', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('facebook_id, name', 'required',
						'message'=>'Hãy vui lòng nhập giá trị cho {attribute}.'),
			array('last_time_login, ban_status', 'numerical', 'integerOnly'=>true),
			array('facebook_id, username, user_address, user_email, user_avatar, name', 'length', 'max'=>255),
			array('user_dob', 'length', 'max'=>20),
			array('username, user_dob, user_address, user_email, last_time_login, user_avatar', 'default', 'setOnEmpty' => true, 'value' => null),
			array('user_id, facebook_id, username, user_dob, user_address, user_email, last_time_login, user_avatar, name, ban_status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'posts' => array(self::HAS_MANY, 'Posts', 'user_id'),
			'reports' => array(self::HAS_MANY, 'Reports', 'user_id'),
			'threads' => array(self::HAS_MANY, 'Threads', array('user_id'=>'user_id'), 'joinType'=>'INNER JOIN'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'user_id' => Yii::t('app', 'Người dùng'),
			'facebook_id' => Yii::t('app', 'Facebook'),
			'username' => Yii::t('app', 'Tên'),
			'user_dob' => Yii::t('app', 'Ngày sinh'),
			'user_address' => Yii::t('app', 'Địa chỉ'),
			'user_email' => Yii::t('app', 'Email'),
			'last_time_login' => Yii::t('app', 'Lần cuối đăng nhập'),
			'user_avatar' => Yii::t('app', 'Ảnh đại diện'),
			'name' => Yii::t('app', 'Tên'),
			'ban_status' => Yii::t('app', 'Trạng thái Ban'),
			'posts' => null,
			'reports' => null,
			'threads' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('facebook_id', $this->facebook_id, true);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('user_dob', $this->user_dob, true);
		$criteria->compare('user_address', $this->user_address, true);
		$criteria->compare('user_email', $this->user_email, true);
		$criteria->compare('last_time_login', $this->last_time_login);
		$criteria->compare('user_avatar', $this->user_avatar, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('ban_status', $this->ban_status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}