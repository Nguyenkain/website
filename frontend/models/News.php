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

	public $picture;
	public $category_search;
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
	
	function defaultScope()
	{
		return array(
				'alias' => $this->tableName()
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('category_id, title, image', 'required',
						'message'=>'Hãy vui lòng nhập giá trị cho {attribute}.'
				),
				array('category_id', 'numerical', 'integerOnly'=>true),
				array('created_time', 'length', 'max'=>11,
						'message' => '{attribute} có số ký tự vượt quá {max} ký tự'
				),
				array('title', 'length', 'max'=>255,'message' => '{attribute} có số ký tự vượt quá {max} ký tự'),
				array('image', 'length', 'max'=>225,'message' => '{attribute} có số ký tự vượt quá {max} ký tự'),
				array('short_description, news_content', 'safe'),
				array('picture', 'length', 'max' => 255, 'tooLong' => '{attribute} is too long (max {max} chars).', 'on' => 'upload'),
				array('picture', 'file', 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!', 'on' => 'upload'),
				// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('news_id, category_id, short_description, news_content, created_time, title, image, category_search', 'safe', 'on'=>'search'),
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
				'categories' => array(self::BELONGS_TO, 'Categories', 'category_id'),
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
				'short_description' => 'Miêu tả ngắn',
				'news_content' => 'Nội dung',
				'created_time' => 'Thời gian tạo',
				'title' => 'Tiêu đề',
				'image' => 'Ảnh minh họa',
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
		
		$criteria->compare('categories.category_id',$this->category_search, true);
		$criteria->with = 'categories';

		$criteria->compare('news_id',$this->news_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('news_content',$this->news_content,true);
		$criteria->compare('created_time','<='.strtotime($this->created_time),false);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider('News', array(
				'criteria'=>$criteria,
				'sort'=>array(
						'defaultOrder' => 'news.created_time DESC',
						'attributes'=>array(
								'category_search'=>array(
										'asc'=>'categories.category_name',
										'desc'=>'categories.category_name DESC',
								),
								'*',
						),
				),
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}
}