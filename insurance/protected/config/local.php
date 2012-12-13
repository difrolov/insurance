<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
	// наследуемся от main.php
	require(dirname(__FILE__).'/main.php'),
		array(
			'components'=>array(
			// переопределяем компонент db
				'db'=>array(
					'connectionString' => 'mysql:host=localhost;dbname=insur_db',
					'emulatePrepare' => true,
					'username' => 'root',
					'password' => '',
					'charset' => 'utf8',
						// включаем профайлер
						'enableProfiling'=>true,
						// показываем значения параметров
						'enableParamLogging' => true,
				),
					'log' => array(
							'class' => 'CLogRouter',
							'routes' => array(
									array(
											'db' => array(
													'class' => 'CWebLogRoute',
													'categories' => 'system.db.CDbCommand',
													'showInFireBug' => true //Показывать в FireBug или внизу каждой страницы
											)

									),
							),
					),

			),

		)
);