<?php

class Post extends ActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'post';
	}
	
	public function rules()
	{
		return array(
			array('name, content', 'required'),
			array('name', 'length', 'max'=>255),
		);
	}
}
