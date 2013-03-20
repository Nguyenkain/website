<?php

/**
 * This is the model base class for the table "reports".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Reports".
 *
 * Columns in table "reports" available as properties of the model,
 * followed by relations of table "reports" available as properties of the model.
 *
 * @property integer $report_id
 * @property integer $thread_id
 * @property integer $user_id
 * @property integer $report_type_id
 * @property string $comment
 *
 * @property Users $user
 * @property ReportTypes $reportType
 */
abstract class BaseReports extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'reports';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Báo cáo|Báo cáo', $n);
	}

	public static function representingColumn() {
		return 'comment';
	}

	public function rules() {
		return array(
			array('thread_id, user_id, report_type_id, comment', 'required'),
			array('thread_id, user_id, report_type_id', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>255),
			array('report_id, thread_id, user_id, report_type_id, comment', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'reportType' => array(self::BELONGS_TO, 'ReportTypes', 'report_type_id'),
			'thread' => array(self::BELONGS_TO, 'Threads', 'thread_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'report_id' => Yii::t('app', 'Báo cáo'),
			'thread_id' => Yii::t('app', 'Chủ đề'),
			'user_id' => Yii::t('app', 'Người báo cáo'),
			'report_type_id' => Yii::t('app', 'Loại báo cáo'),
			'comment' => Yii::t('app', 'Miêu tả'),
			'user' => null,
			'reportType' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('report_id', $this->report_id);
		$criteria->compare('thread_id', $this->thread_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('report_type_id', $this->report_type_id);
		$criteria->compare('comment', $this->comment, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}