<?php
class DefaultController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.banner";

	public function actionIndex(){

		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login/admin'));
		}
		$this->render('index');
	}

	public function actions() {
		return array(
            'connector' => array(
                'class' => 'application.extensions.elfinder.ElFinderConnectorAction',
                /* 'options' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/upload/',
                    'URL' => Yii::app()->baseUrl . '/upload/',
                    'rootAlias' => Yii::app()->baseUrl,
                    'mimeDetect' => 'none'
                ) */
            	/* 'roots'=>array(
			              array(
			                  'driver'  => "LocalFileSystem",
			                  'path' => realpath(Yii::app()->basePath . "/../upload"),
			                  'URL' => "/upload",
			                  'accessControl' => "access"
			              )
            	) */
        	)
		);
	}

	public function actionBrowser() {
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
	    $this->render('browser');
	}

}