<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.widgets.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'simen',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
*/
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
	),

	// application components
	'components'=>array(
		/*'request'=>array(
			'baseUrl'=>'http://h.com',
		),*/
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(
				'solutions'=>'project',
				'solutions/<subvalue:[^\/]+>'=>'project/index',
				//'solutions/<id:\d+>'=>'solutions/view',
				//'solutions/<action:\w+>'=>'project/<action>',
				'accessibility'=>'site/accessibility',
				'privacy'=>'site/privacy',
				'terms'=>'site/terms',
				'lang/<lang:\w+>'=>'site/lang',
				'about'=>'site/about',
				'about/partners'=>'site/aboutPartners',
				'about/apply_a_partner'=>'cooperation',
				'about/apply_a_partner/finish'=>'cooperation/finish',
				'about/<target:[^\/]+>'=>'site/about',
				'support'=>'site/support',
				'support/FAQ'=>'site/supportFaq',
				'support/service'=>'site/supportRepaire',
				'support/repaire'=>'site/supportRepaire2',
				'support/online_support'=>'question',
				'support/online_support/finish'=>'question/finish',
				'support/<target:[^\/]+>'=>'site/support',
				'products/how_to_buy/finish'=>'product/finish',
				'product/how_to_buy'=>'product/buy',
				'products/how_to_buy'=>'product/buy',
				'products/<subvalue:[^\/]+>/[^_]+_<id:\d+>'=>'product/view',
				'products/<subvalue:[^\/]+>'=>'product/index',
				'products'=>'product',
				'question/<action:\w+>'=>'question/<action>',
				'questionnaire/<action:\w+>'=>'questionnaire/<action>',
				'cooperation/<action:\w+>'=>'cooperation/<action>',
				'download/<imagedir:[^\/]+>/<imagefile:[^\/]+>'=>'download/image',
				'news/index/<subvalue:[^\/]+>/<Event1311News_page:\d+>'=>'news/index',
				'news/index/<Event1311News_page:\d+>'=>'news/index',
				'news/index'=>'news/index',
				'<controller:\w+>/search'=>'<controller>/search',
				'<controller:\w+>/<subvalue:[^\/]+>/[^_]+_<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<subvalue:[^\/]+>'=>'<controller>/index',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
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
				/*array(
				  'class'=>'CWebLogRoute',  'levels'=>'trace, info, error, warning',
				),
				array(
				  'class'=>'CFileLogRoute',  'levels'=>'trace, info, error, warning',
				),*/
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
