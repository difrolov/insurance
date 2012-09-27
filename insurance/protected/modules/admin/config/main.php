<?php
return CMap::mergeArray(
		require('/../config/local.php'),
		array(
			'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
			'defaultController' => 'default',
			'preload'=>array(
				'bootstrap', // preload the bootstrap component
			),
			'components'=>array(
				'bootstrap'=>array(
					'class'=>'application.extensions.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
				),
			),
			'modules'=>array(
				'gii'=>array(
					'generatorPaths'=>array(
						'bootstrap.gii',
					),
				),
			),
		)
);
?>