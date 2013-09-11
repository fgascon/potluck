<?php

class SiteController extends Controller
{
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionPotluck()
	{
		$foods = array(
			Food::CAT_ENTRE=>array(),
			Food::CAT_PRINCIPAL=>array(),
			Food::CAT_DESSERT=>array(),
		);
		$models = Food::model()->findAll();
		foreach($models as $model)
		{
			$foods[$model->category][] = $model;
		}
		$this->render('potluck', array(
			'foods'=>$foods,
		));
	}
}
