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
$this->widget('application.extensions.elfinder.ElFinderWidget', array(
		'connectorRoute' =>  'admin/default/connector',
)
);

?>