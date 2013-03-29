<?php

Yii::import('application.models._base.BaseNationalParks');

class NationalParks extends BaseNationalParks
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}