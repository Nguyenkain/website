<?php

/**
 * This is the model base class for the table "vnc.ho".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Ho".
 *
 * Columns in table "vnc.ho" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $ID
 * @property string $Viet
 * @property string $LaTin
 * @property integer $Bo
 *
 */
abstract class BaseHo extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'ho';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Ho|Hos', $n);
	}

	public static function representingColumn() {
		return 'Viet';
	}

	public function rules() {
		return array(
			array('ID, Bo', 'numerical', 'integerOnly'=>true),
			array('Viet, LaTin', 'length', 'max'=>50),
			array('ID, Viet, LaTin, Bo', 'default', 'setOnEmpty' => true, 'value' => null),
			array('ID, Viet, LaTin, Bo', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
				'ID' => array(self::HAS_MANY, 'Creatures', 'Ho'),
				'rBo' => array(self::BELONGS_TO,'Bo','Bo'),
		);
	}

	public function pivotModels() {
		return array(
				
		);
	}

	public function attributeLabels() {
		return array(
			'ID' => Yii::t('app', 'ID'),
			'Viet' => Yii::t('app', 'Tên Việt'),
			'LaTin' => Yii::t('app', 'Tên La Tin'),
			'Bo' => Yii::t('app', 'Bộ'),
				'rBo'=>Yii::t('app', 'Bộ'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('ID', $this->ID);
		$criteria->compare('Viet', $this->Viet, true);
		$criteria->compare('LaTin', $this->LaTin, true);
		$criteria->compare('Bo', $this->Bo);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}