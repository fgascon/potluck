<?php

class AdminController extends BaseAdminController
{
	
	public function actionIndex()
	{
		$this->render('index', array(
			'counts'=>Food::categoriesCounts(),
		));
	}
	
	public function actionAddFood($category)
	{
		$model = new Food();
		$model->category = $category;
		if(!$model->save())
			throw new CHttpException(500, "Failed to add food");
		$this->redirect(array('index'));
	}
}
