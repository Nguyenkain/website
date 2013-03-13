<?php

/**
 * This is the model class for table "national_parks".
 *
 * The followings are the available columns in table 'national_parks':
 * @property integer $id
 * @property string $park_name
 * @property string $park_description
 * @property double $longitude
 * @property double $latitude
 */
class NationalParks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NationalParks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'national_parks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('park_name, park_description, longitude, latitude', 'required'),
		array('longitude, latitude', 'numerical'),
		array('park_name', 'length', 'max'=>255),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, park_name, park_description, longitude, latitude', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'park_name' => 'Tên Vườn Quốc Gia',
			'park_description' => 'Mô tả Vườn Quốc Gia',
			'longitude' => 'Kinh độ',
			'latitude' => 'Vĩ độ',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('park_name',$this->park_name,true);
		$criteria->compare('park_description',CHtml::decode($this->park_description),true);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('latitude',$this->latitude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}