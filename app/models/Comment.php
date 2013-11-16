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
	
	public function attributeLabels()
	{
		return array(
			'post_id'=>"Article",
			'user_id'=>"Personne",
			'created_date'=>"Date",
			'content'=>"Contenu",
		);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			$this->user_id = Yii::app()->user->id;
			$this->created_date = date('Y-m-d H:i:s');
			return true;
		}
		else
			return false;
	}
}
