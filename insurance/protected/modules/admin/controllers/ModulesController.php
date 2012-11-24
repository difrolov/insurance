<?php
class ModulesController extends Controller{
	public $layout = "application.modules.admin.views.layouts.banner";

	public function actionIndex(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$this->render('index');
	}

	public function actionGetmodules(){

	}

	public function actionJobs(){
		$model = new InsurJobs();
		if(isset($_POST['InsurJobs'])){
			$model->attributes = $_POST['InsurJobs'];
			$model->creat_date = date("Y-m-d H:i:s");
			$model->save();
		}elseif(isset($_GET['id'])){
			$model = InsurJobs::model()->findByPk($_GET['id']);

		}
		$this->render('jobs',array('model'=>$model));
	}
	public function actionGetJobs(){
		$model = new InsurJobs();
		$gridDataProvider = $model->search();
		$this->render('getjobs',array('gridDataProvider'=>$gridDataProvider));
	}

}
