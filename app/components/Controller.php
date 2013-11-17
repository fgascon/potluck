<?php

class Controller extends CController
{
	
	public $assets;
	
	public function init()
	{
		parent::init();
		Yii::app()->clientScript->registerPackage('jquery');
		$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.assets'), false, -1, YII_DEBUG);
	}
	
	protected function json($data, $endApplication=true)
	{
		header('Content-type: application/json');
		echo CJSON::encode($data);
		if($endApplication)
			Yii::app()->end();
	}
}