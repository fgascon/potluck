<?php

class SiteController extends Controller
{
	
	public function actionIndex()
	{
		$this->layout = 'connected';
		$posts = Post::model()->findAll(array(
			'order'=>'created_at DESC',
		));
		$this->render('index', array(
			'posts'=>$posts,
		));
	}
	
	public function actionPotluck()
	{
		$this->layout = 'connected';
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
	
	public function actionError()
	{
		if($error = Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    	{
	    		echo $error['message'];
	    	}
	    	else
	    	{
	        	$this->render('error', $error);
	    	}
	    }
		else
		{
			$this->redirect(array('index'));
		}
	}
}
