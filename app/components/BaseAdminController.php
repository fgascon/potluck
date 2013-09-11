<?php

class BaseAdminController extends Controller
{
	
	public $layout = 'admin';
	
	public function init()
	{
		parent::init();
		
		$user = Yii::app()->user;
		if($user->isGuest)
			$this->redirect(array('site/login', 'return'=>Yii::app()->request->url));
		
		if(!$user->isAdmin)
			throw new CHttpException(403, "Accès interdit");
	}
}
