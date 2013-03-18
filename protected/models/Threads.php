<?php

Yii::import('application.models._base.BaseThreads');

class Threads extends BaseThreads
{
	public $reports_count;
	private $idCache;
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function searchReports() {
		$criteria = new CDbCriteria;
	
		$criteria->compare('users.name',$this->user_search, true);
		$criteria->with = 'users';
	
		$criteria->select = array(
				'*',
				'count(*) as reports_count',
		);
		$criteria->join = 'JOIN Reports r on r.thread_id = threads.thread_id';
		$criteria->group = 'threads.thread_id';
	
		$criteria->compare('thread_id', $this->thread_id);
		$criteria->compare('last_modified_time', $this->last_modified_time);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('thread_title', $this->thread_title, true);
		$criteria->compare('thread_content', $this->thread_content, true);
		$criteria->compare('thread_created_time', '<='.strtotime($this->thread_created_time), false);
		$criteria->compare('last_posted_time', $this->last_posted_time);
	
		/* return new CActiveDataProvider($this, array(
		 'criteria' => $criteria,
		)); */
	
		return new CActiveDataProvider( 'Threads', array(
				'criteria'=>$criteria,
				'sort'=>array(
						'attributes'=>array(
								'user_search'=>array(
										'asc'=>'users.name',
										'desc'=>'users.name DESC',
								),
								'reports_count' => array(
										'asc' => 'reports_count ASC',
										'desc' => 'reports_count DESC',
								),
								'*',
						),
				),
		));
	}
	
	public function beforeDelete()
	{
		$this->idCache = $this->thread_id;
	
		return parent::beforeDelete();
	}
	
	public function afterDelete()
	{
		$criteria = new CDbCriteria(array(
				'condition' => 'thread_id=:parentId',
				'params' => array(
						':parentId' => $this->idCache),
		));
	
		$children = Posts::model()->findAll($criteria);
		$childrenReport = Reports::model()->findAll($criteria);
	
		foreach ($children as $child)
		{
			$child->delete();
		}
		
		foreach ($childrenReport as $child)
		{
			$child->delete();
		}
	
		parent::afterDelete();
	}
}
