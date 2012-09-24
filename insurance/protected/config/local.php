<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'charset'=>'UTF-8',
	'language'=>'ru',
	'timeZone'=>'Europe/Moscow',

	// preloading 'log' component
	'preload'=>array('log'),
	'defaultController' => 'site',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.helpers.*',

	),

		'preload'=>array(
			'bootstrap', // preload the bootstrap component
		),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123qwe123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin'=>array(
			'class'=>'application.modules.admin.AdminModule',
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'WebUser',
			'allowAutoLogin'=>true,
			'loginUrl'=>array('user/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				// правила для обработки URL подразделов:
				'o_kompanii/<alias:\w+>' =>  'o_kompanii/index',
				'korporativnym_klientam/<alias:\w+>' =>  'korporativnym_klientam/index',
				'malomu_i_srednemu_biznesu/<alias:\w+>' =>  'malomu_i_srednemu_biznesu/index',
				'fizicheskim_litzam/<alias:\w+>' =>  'fizicheskim_litzam/index',
				'partneram/<alias:\w+>' =>  'partneram/index',
				// admin:
				'admin'=>'admin',
				'admin/<controller:\w+>'=>'admin/<controller>',
				'admin/<controller:\w+>/<action:\w+>/show/<show:\d+>'=>'admin/<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>/show/<show:\w+>'=>'admin/<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>/prid/<prid:\d+>'=>'admin/<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>/rid/<rid:\d+>'=>'admin/<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>/run/<run:\w+>'=>'admin/<controller>/<action>',
				'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
				// common rules:
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'authManager'=>array(
				'class'=>'PhpAuthManager',
				'defaultRoles'=>array('guest'),
		),
		/* 'bootstrap'=>array(
				'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		), */

		/* 'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		), */
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=insur_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
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
				array(
           			 'class' => 'CWebLogRoute',
			         'categories' => 'application',
			         'showInFireBug' => true,
			    ),
				/* array(
					'class'=>'FirePHP',
					'config'=>array(
							'enabled'=>false,
							'dateFormat'=>'Y/m/d H:i:s',
					),
					'levels'=>'error, warning, trace, profile, info',
				), */
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