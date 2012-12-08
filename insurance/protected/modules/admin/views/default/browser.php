<br class="clear">
<div id="file-uploader"></div>

<?php

/* $this->widget('application.extensions.elfinder.ElFinderWidget',array(
    'lang'=>'ru',
    'url'=>realpath(Yii::app()->basePath . "/../upload"),
    'editorCallback'=>'js:function(url) {
        var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
        window.opener.CKEDITOR.tools.callFunction(funcNum, url);
        window.close();
    }',
)); */
/* $this->widget('application.extensions.elfinder.ElFinderWidget', array(
		'connectorRoute' =>  '/admin/default/connector',


		//'settings' => array('toolbar'=>'all')
)
);
<div id="file-uploader"></div> */



$filesPath = realpath(Yii::app()->basePath . "/../upload");
$filesUrl = Yii::app()->baseUrl . "/upload";

$this->widget('application.extensions.elfinder.ElFinderWidget', array(
		'selector' => "div#file-uploader",
		'clientOptions' => array(
				'lang' => "ru",
				'resizable' => false,
				'wysiwyg' => "ckeditor"
		),
		'connectorRoute' => "/admin/default/connector",
		'connectorOptions' => array(
				'roots' => array(
						array(
								'driver'  => "LocalFileSystem",
								'path' => $filesPath,
								'URL' => $filesUrl,
								'tmbPath' => $filesPath . DIRECTORY_SEPARATOR . ".thumbs",
								'mimeDetect' => "internal",
								'accessControl' => "access"
						)
				)
		)
));

?>
