<?php

class CommentsController extends Controller
{
	
	public function init()
	{
		parent::init();
		
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));
	}
	
	public function actionList($post_id, $min_id=0)
	{
		$comments = Comment::model()->findAll(array(
			'condition'=>'post_id = :post_id AND id > :min_id',
			'params'=>array(
				':post_id'=>$post_id,
				':min_id'=>$min_id,
			),
			'order'=>'id DESC',
		));
		
		$output = array();
		foreach($comments as $comment)
			$output[] = array(
				'id'=>$comment->id,
				'content'=>$comment->content,
				'post_id'=>$comment->post_id,
				'date_created'=>$comment->date_created,
				'user'=>array(
					'id'=>$comment->user_id,
					'name'=>$comment->user->name,
				),
			);
		$this->json($output);
	}
	
	public function actionCreate($post_id)
	{
		if(!Yii::app()->request->isPostRequest)
			$this->json(array(
				'result'=>'error',
				'error'=>"invalid request",
			));
		
		$comment = new Comment();
		if(isset($_POST['content']))
			$comment->content = $_POST['content'];
		$comment->post_id = $post_id;
		
		if($comment->save())
		{
			$this->json(array(
				'result'=>'success',
				'data'=>$comment->attributes,
			));
		}
		else
		{
			$this->json(array(
				'result'=>'error',
				'errors'=>$comment->errors,
			));
		}
	}
}
