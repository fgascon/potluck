<?php

return array(
	
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'db'=>array(
            'connectionString'=>'mysql:host=127.0.0.1;dbname=potluck',
            'username'=>'potluck',
            'password'=>'mJbqfYFFq4QZG964',
            'emulatePrepare'=>true, 
		),
	),
);