<?php

/**
 * This is the model base class for the table "coordinations".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Coordinations".
 *
 * Columns in table "coordinations" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $province_id
 * @property string $province_name
 * @property double $longitude
 * @property double $latitude
 *
 */
abstract class BaseCoordinations extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'coordinations';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Coordinations|Coordinations', $n);
	}

	public static function representingColumn() {
		return 'province_name';
	}

	public function rules() {
		return array(
				array('province_id, province_name, longitude, latitude', 'required',
						'message'=>'Hãy vui lòng nhập giá trị cho {attribute}.'),
				array('province_id', 'numerical', 'integerOnly'=>true),
				array('longitude, latitude', 'numerical'),
				array('province_name', 'length', 'max'=>50),
				array('province_id, province_name, longitude, latitude', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
				'province_id' => Yii::t('app', 'ID'),
				'province_name' => Yii::t('app', 'Tên địa điểm phân bố'),
				'longitude' => Yii::t('app', 'Kinh độ'),
				'latitude' => Yii::t('app', 'Vĩ độ'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('province_id', $this->province_id);
		$criteria->compare('province_name', $this->province_name, true);
		$criteria->compare('longitude', $this->longitude);
		$criteria->compare('latitude', $this->latitude);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
				'sort'=>array(
						'defaultOrder'=>'province_name ASC',
				)
		));
	}
}