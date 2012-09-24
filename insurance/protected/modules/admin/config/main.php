<?php
return CMap::mergeArray(
		require('/../config/main.php'),
		array(
			'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
			'defaultController' => 'default',
			'bootstrap'=>array(
				'class'=>'application.extensions.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
			),
		)
);
?>