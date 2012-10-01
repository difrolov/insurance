<?php
/* var_dump($model);die; */
$this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
		"model"=>$model[0],                # Data-Model
		"attribute"=>'content',         # Attribute in the Data-Model
		"height"=>'400px',
		"width"=>'100%',
		"toolbarSet"=>'Basic',          # EXISTING(!) Toolbar (see: fckeditor.js)
		"fckeditor"=>Yii::app()->basePath."/extensions/fckeditor/fckeditor.php",
		# Path to fckeditor.php
		"fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
		# Realtive Path to the Editor (from Web-Root)
		"config" => array("EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',),
		# Additional Parameter (Can't configure a Toolbar dynamicly)
) ); ?>
