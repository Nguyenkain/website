<?php

/**
 * This is the model base class for the table "vnc.nhom".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Nhom".
 *
 * Columns in table "vnc.nhom" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $ID
 * @property string $Viet
 * @property string $LaTin
 * @property integer $Loai
 * @property string $icon
 *
 */
abstract class BaseNhom extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'vnc.nhom';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Nhom|Nhoms', $n);
	}

	public static function representingColumn() {
		return 'Viet';
	}

	public function rules() {
		return array(
			array('ID, Loai', 'numerical', 'integerOnly'=>true),
			array('Viet, LaTin', 'length', 'max'=>50),
			array('icon', 'length', 'max'=>200),
			array('ID, Viet, LaTin, Loai, icon', 'default', 'setOnEmpty' => true, 'value' => null),
			array('ID, Viet, LaTin, Loai, icon', 'safe', 'on'=>'search'),
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
			'ID' => Yii::t('app', 'ID'),
			'Viet' => Yii::t('app', 'Viet'),
			'LaTin' => Yii::t('app', 'La Tin'),
			'Loai' => Yii::t('app', 'Loai'),
			'icon' => Yii::t('app', 'Icon'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('ID', $this->ID);
		$criteria->compare('Viet', $this->Viet, true);
		$criteria->compare('LaTin', $this->LaTin, true);
		$criteria->compare('Loai', $this->Loai);
		$criteria->compare('icon', $this->icon, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}