<?php

class DefaultController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex(){

		if(!Yii::app()->user->checkAccess('admin')){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$this->render('index');
	}

	public function actions() {
	    return array(
            'connector' => array(
                'class' => 'application.extensions.elfinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . '/upload/',
                    'URL' => Yii::app()->baseUrl . '/upload/',
                    'rootAlias' => 'http://localhost/insur/insurance/',
                    'mimeDetect' => 'none'
                )
            ),
        );
	}

	public function actionBrowser() {
	    $this->render('browser');
	}

}