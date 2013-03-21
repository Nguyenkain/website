<?php

Yii::import('application.models._base.BaseCreatures');

class Creatures extends BaseCreatures
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}