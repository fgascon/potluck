<?php

class FoodController extends BaseAdminController
{
	
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if(isset($_POST['Food']))
		{
			$model->attributes = $_POST['Food'];
			if($model->save())
			{
				$this->redirect(array('admin/index'));
			}
		}
		$this->render('update', array(
			'model'=>$model,
		));
	}
	
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isPostRequest)
			throw new CHttpException(400, "Requête invalide");
		$model = $this->loadModel($id);
		if(!$model->delete())
			throw new CHttpException(500, "Impossible de supprimer");
		if(!Yii::app()->request->isAjaxRequest)
			$this->redirect(array('admin/index'));
	}
	
	private function loadModel($id)
	{
		$model = Food::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, "Plat introuvable dans la BD");
		return $model;
	}
}
