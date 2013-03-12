<?php

/**
 * This is the model class for table "vnc.creatures".
 *
 * The followings are the available columns in table 'vnc.creatures':
 * @property integer $ID
 * @property string $Viet
 * @property string $Latin
 * @property integer $Loai
 * @property integer $Ho
 * @property integer $Bo
 * @property integer $Nhom
 * @property string $Description
 * @property string $Img
 * @property integer $Author
 * @property string $AuthorName
 */
class Creatures extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Creatures the static model class
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
		return 'vnc.creatures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, Loai, Ho, Bo, Nhom, Author', 'numerical', 'integerOnly'=>true),
			array('Viet, Latin, AuthorName', 'length', 'max'=>50),
			array('Img', 'length', 'max'=>200),
			array('Description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Viet, Latin, Loai, Ho, Bo, Nhom, Description, Img, Author, AuthorName', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'Viet' => 'Việt',
			'Latin' => 'Latin',
			'Loai' => 'Loài',
			'Ho' => 'Họ',
			'Bo' => 'Bộ',
			'Nhom' => 'Nhóm',
			'Description' => 'Description',
			'Img' => 'Img',
			'Author' => 'Author',
			'AuthorName' => 'Tên tác giả',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Viet',$this->Viet,true);
		$criteria->compare('Latin',$this->Latin,true);
		$criteria->compare('Loai',$this->Loai);
		$criteria->compare('Ho',$this->Ho);
		$criteria->compare('Bo',$this->Bo);
		$criteria->compare('Nhom',$this->Nhom);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Img',$this->Img,true);
		$criteria->compare('Author',$this->Author);
		$criteria->compare('AuthorName',$this->AuthorName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}