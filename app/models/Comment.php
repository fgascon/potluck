<?php

class Comment extends ActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'comment';
	}
	
	public function rules()
	{
		return array(
			array('content', 'required'),
			array('post_id', 'numerical', 'integerOnly'=>true),
		);
	}
	
	public function relations()
	{
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'post_id'=>"Article",
			'user_id'=>"Personne",
			'date_created'=>"Date",
			'content'=>"Contenu",
		);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->user_id = Yii::app()->user->id;
			$this->date_created = date('Y-m-d H:i:s');
			return true;
		}
		else
			return false;
	}
}
