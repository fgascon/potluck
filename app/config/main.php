<?php

return array(
	'name'=>'potluck',
	'basePath'=>$appPath,
	'sourceLanguage'=>'fr',
	'language'=>'fr',
	
	'preload'=>array('log'),
	
	'import'=>array(
		'application.components.*',
		'application.models.*',
	),
	
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
		),
		'errorHandler'=>array(
            'errorAction'=>'/site/error',
        ),
		'cache'=>array(
			'class'=>'CFileCache',
		),
		'user'=>array(
			'class'=>'WebUser',
		),
	),
);