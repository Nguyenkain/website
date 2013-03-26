<?php

Yii::import('application.models._base.BaseUsers');

class Users extends BaseUsers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function addNewUser() {
		$model = Users::model();
		$criteria = new CDbCriteria;
				
		$criteria->compare('facebook_id', $this->facebook_id, true);
		try {
			if(!$model->exists($criteria)) {
				$this->save();
			}			
		} catch (Exception $e) {
			error_log($e);
		}
		
	}
}