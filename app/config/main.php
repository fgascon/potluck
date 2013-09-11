<?php

return array(
	'name'=>'potluck',
	'basePath'=>$appPath,
	'import'=>array(
		'application.components.*',
		'application.models.*',
	),
	
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
		),
		'user'=>array(
			'class'=>'WebUser',
		),
	),
);