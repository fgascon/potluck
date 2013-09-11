<?php

class Food extends ActiveRecord
{
	const CAT_ENTRE = 1;
	const CAT_PRINCIPAL = 2;
	const CAT_DESSERT = 3;
	
	public static function categoriesNames()
	{
		return array(
			self::CAT_ENTRE=>"Entrée",
			self::CAT_PRINCIPAL=>"Plat principal",
			self::CAT_DESSERT=>"Dessert",
		);
	}
	
	public static function categoriesCounts()
	{
		$categories = self::categoriesNames();
		$counts = array();
		foreach($categories as $category=>$label)
		{
			$counts[$category] = Yii::app()->db->createCommand('SELECT COUNT(*) FROM food WHERE category = :category')->queryScalar(array(
				':category'=>$category,
			));
		}
		return $counts;
	}
	
	public static function categoryLabel($category)
	{
		$categories = self::categoriesNames();
		return isset($categories[$category]) ? $categories[$category] : '';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'food';
	}
	
	public function rules()
	{
		return array(
			array('category', 'required'),
			array('category', 'in', 'range'=>array(self::CAT_ENTRE, self::CAT_PRINCIPAL, self::CAT_DESSERT)),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>512),
		);
	}
	
	public function relations()
	{
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	
	public function getCategoryName()
	{
		return self::categoryLabel($this->category);
	}
}
