<?php
class MenuController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.banner";

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionGetMainMenu(){

		if(!Yii::app()->user->checkAccess('admin')){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

			//достаём главное меню из базы
			$object = InsurInsuranceObject::model()->findAll(array("condition"=>"parent_id=-1"));
			$this->render('getmainmenu',array('menu'=>$object));

	}
}