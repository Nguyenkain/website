<?php

Yii::import('application.models._base.BaseBo');

class Bo extends BaseBo
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}