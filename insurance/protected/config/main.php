<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Открытие.Страхование &#8212; в составе финансовой корпорации &laquo;Открытие&raquo;.',
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
		'application.modules.admin.components.*',

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
			'caseSensitive'=>false,
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(

				// правила для обработки URL подразделов:
				// admin:
				'admin'=>'admin',
				// редактирование макета подраздела:
				'admin/<controller:\w+>/edit/<section_id:\d+>'=>'admin/<controller>/edit',
				//
				'admin/<controller:\w+>/<id:\d+>'=>'admin/<controller>',
                'admin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin/<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',


				// Frontend
				// извлечь данные подразделов:
				'o_kompanii/*' =>  'o_kompanii/index',

				'korporativnym_klientam/*' =>  'korporativnym_klientam/index',

				'malomu_i_srednemu_biznesu/*' =>  'malomu_i_srednemu_biznesu/index',

				'fizicheskim_litzam/*' =>  'fizicheskim_litzam/index',

				'partneram/*' =>  'partneram/index',
				'esli_proizoshel_strahovoj_sluchay/*' =>  'esli_proizoshel_strahovoj_sluchay/index',

				//
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/n_present/<n_present:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/y_present/<y_present:\w+>'=>'<controller>/<action>',

			),
		),
		'authManager'=>array(
				'class'=>'PhpAuthManager',
				'defaultRoles'=>array('guest'),
		),
		 'bootstrap'=>array(
				'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
				'coreCss'=>false,
		),
		'db'=>array(
				'connectionString' => 'mysql:host=insur.mysql;dbname=insur_db',
				'emulatePrepare' => true,
				'username' => 'insur_mysql',
				'password' => '64z3tzev',
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
		'email'=>array(
			'class'=>'application.extensions.email.components.Email',
			'delivery'=>'php', //Will use the php mailing function.
			//May also be set to 'debug' to instead dump the contents of the email into the view
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'srgg140201@yandex.ru',
	),
);