<?php

class User extends ActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'user';
	}
	
	public function rules()
	{
		return array(
			array('name, username, pass', 'required'),
			array('name, username, pass', 'length', 'max'=>255),
		);
	}
}
