<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property integer $category_id
 * @property string $short_description
 * @property string $news_content
 * @property string $created_time
 * @property string $title
 * @property string $image
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, title, image', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('created_time', 'length', 'max'=>11),
			array('title', 'length', 'max'=>255),
			array('image', 'length', 'max'=>225),
			array('short_description, news_content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('news_id, category_id, short_description, news_content, created_time, title, image', 'safe', 'on'=>'search'),
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
			'news_id' => 'News',
			'category_id' => 'Category',
			'short_description' => 'Short Description',
			'news_content' => 'News Content',
			'created_time' => 'Created Time',
			'title' => 'Title',
			'image' => 'Image',
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

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('news_content',$this->news_content,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}