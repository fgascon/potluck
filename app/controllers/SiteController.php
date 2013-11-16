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
			'order'=>'position ASC',
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
		$foodsByCategories = array(
			Food::CAT_ENTRE=>array(),
			Food::CAT_PRINCIPAL=>array(),
			Food::CAT_DESSERT=>array(),
		);
		$foods = Food::model()->findAll();
		foreach($foods as $food)
		{
			$foodsByCategories[$food->category][] = $food;
		}
		$this->render('potluck', array(
			'foods'=>$foods,
			'foodsByCategories'=>$foodsByCategories,
		));
	}
	
	public function actionChange($id)
	{
		if(!isset($_POST['description']))
			throw new CHttpException(400, "Invalid request");
		$model = Food::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, "Not found");
		
		if($model->user_id && $model->user_id != Yii::app()->user->id)
			throw new CHttpException(403, "Not allowed");
		
		$model->description = $_POST['description'];
		if(empty($model->description))
			$model->user_id = null;
		else
			$model->user_id = Yii::app()->user->id;
		if(!$model->save())
			throw new CHttpException(500, "Failed to save");
		
		return 'OK';
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
