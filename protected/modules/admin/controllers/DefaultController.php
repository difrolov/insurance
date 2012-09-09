<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{

		if(Yii::app()->user->checkAccess('admin')){
	    	echo "hello, I'm administrator";die;
		}
		$this->render('index');
	}

	/* public function filters()
	{
		return array(
			'accessControl',
		);
	}
	public function accessRules()
	{
		return array(
				array('allow',
						'actions'=>array('index'),
						'roles'=>array('admin'),
				),
				array('deny',
				        'actions'=>array('read'),
				),
		);
	} */
}