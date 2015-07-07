<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'YouJie 优解 -- 控制台',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'simen',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
*/
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(
//				''=>'site/login',
				'login'=>'site/login',
				'logout'=>'site/logout',
				'about'=>'site/about',
				'about/<target:[^\/]+>'=>'site/about',
				'about/update/<target:[^\/]+>'=>'site/aboutUpdate',
				'support'=>'site/support',
				'support/<target:[^\/]+>'=>'site/support',
				'support/update/<target:[^\/]+>'=>'site/supportUpdate',
				'lang/<lang:\w+>'=>'site/lang',
				'login/<lang:\w+>'=>'site/login',
				'<controller:\w+>/sub/<subvalue:[^\/]+>'=>'<controller>/sub',
				'<controller:\w+>/adminSub/<subvalue:[^\/]+>'=>'<controller>/adminSub',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=a11041749493',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'a110417494933',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
/*
				array(
					'class'=>'CWebLogRoute',
					'levels' => 'trace,info,profile,warning,error',
				),

                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'profile',
                ),
*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
