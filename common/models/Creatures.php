<?php

Yii::import('application.models._base.BaseCreatures');

class Creatures extends BaseCreatures
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function searchFront() {
		$criteria = new CDbCriteria;
		$sort = new CSort;
		$sort->defaultOrder = 'ID DESC';
		$criteria->compare('ID', $this->ID);
		$criteria->compare('Viet', $this->Viet, true, 'OR');
		$criteria->compare('Latin', $this->Viet, true, 'OR');
		$criteria->compare('Loai', $this->Loai);
		$criteria->compare('Ho', $this->Ho);
		$criteria->compare('Bo', $this->Bo);
		$criteria->compare('Nhom', $this->Nhom);
		$criteria->compare('Description', $this->Description, true);
		$criteria->compare('Img', $this->Img, true);
		$criteria->compare('Author', $this->Author);
		$criteria->compare('AuthorName', $this->AuthorName, true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => $sort,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}
	
}