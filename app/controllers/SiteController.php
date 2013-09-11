<?php

class SiteController extends Controller
{
	
	public $defaultAction = 'login';
	
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('info'));
		
		$model = new LoginForm();
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect(isset($_GET['return']) ? $_GET['return'] : array('info'));
		}
		$this->render('login', array(
			'model'=>$model,
		));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('login'));
	}
	
	public function actionInfo()
	{
		if(Yii::app()->user->isGuest)
			$this->redirect(array('login'));
		
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
		if(Yii::app()->user->isGuest)
			$this->redirect(array('login'));
		
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
