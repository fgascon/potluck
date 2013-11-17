<?php

class PostController extends BaseAdminController
{
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCreate()
	{
		$model = new Post();
		$this->saveModel($model);
		$this->render('create', array(
			'model'=>$model,
		));
	}
	
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$this->saveModel($model);
		$this->render('update', array(
			'model'=>$model,
		));
	}
	
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isPostRequest)
			throw new CHttpException(400, "Invalid request");
		$model = $this->loadModel($id);
		if(!$model->delete())
			throw new CHttpException(500, "Failed to delete post");
		$this->redirect(array('index'));
	}
	
	public function actionUpdateComment($id)
	{
		$model = Comment::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, "Not found");
		if(isset($_POST['Comment']))
		{
			$model->attributes = $_POST['Comment'];
			if($model->save())
				$this->redirect(array('update', 'id'=>$model->post_id));
		}
		$this->render('updateComment', array(
			'model'=>$model,
		));
	}
	
	public function actionDeleteComment($id)
	{
		if(!Yii::app()->request->isPostRequest)
			throw new CHttpException(400, "Invalid request");
		
		$model = Comment::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, "Not found");
		
		if(!$model->delete())
			throw new CHttpException(500, "Failed to delete comment");
		
		if(!Yii::app()->request->isAjaxRequest)
			$this->redirect(array('update', 'id'=>$model->post_id));
	}
	
	protected function loadModel($id)
	{
		$model = Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, "Not found");
		return $model;
	}
	
	protected function saveModel($model)
	{
		if(isset($_POST['Post']))
		{
			$model->attributes = $_POST['Post'];
			if($model->save())
				$this->redirect(array('index'));
		}
	}
}
