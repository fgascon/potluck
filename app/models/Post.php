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
			array('name, content, position', 'required'),
			array('name', 'length', 'max'=>255),
			array('position', 'numerical', 'integerOnly'=>true),
		);
	}
	
	public function relations()
	{
		return array(
			'comments'=>array(self::HAS_MANY, 'Comment', 'post_id'),
			'commentsCount'=>array(self::STAT, 'Comment', 'post_id'),
		);
	}
}
