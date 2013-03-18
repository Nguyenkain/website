<?php

/**
 * This is the model base class for the table "report_types".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ReportTypes".
 *
 * Columns in table "report_types" available as properties of the model,
 * followed by relations of table "report_types" available as properties of the model.
 *
 * @property integer $report_type_id
 * @property string $report_type
 *
 * @property Reports[] $reports
 */
abstract class BaseReportTypes extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'report_types';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Loại báo cáo|Loại báo cáo', $n);
	}

	public static function representingColumn() {
		return 'report_type';
	}

	public function rules() {
		return array(
			array('report_type', 'required'),
			array('report_type', 'length', 'max'=>255),
			array('report_type_id, report_type', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'reports' => array(self::HAS_MANY, 'Reports', 'report_type_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'report_type_id' => Yii::t('app', 'Loại Báo Cáo'),
			'report_type' => Yii::t('app', 'Tên loại báo cáo'),
			'reports' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('report_type_id', $this->report_type_id);
		$criteria->compare('report_type', $this->report_type, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}