<?php
class BannerController extends Controller{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$this->render('index');
	}

	public function actionGetBanner(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$model = new InsurBanners();
		$gridDataProvider = $model->search();
		$this->render('getbanner',array('gridDataProvider'=>$gridDataProvider));
	}
	public function actionAjaxUpdate(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_POST['id']) && isset($_POST['field']) && isset($_POST['val'])){
			$query = InsurBanners::model()->find(array('condition'=>'id='.$_POST['id']));
			$query->$_POST['field'] = $_POST['val'];
			if($query->save()){
				echo '{success:1}';
				exit;
			}
			echo '{success:ошбка вставки в БД}';
			exit;
		}
		echo '{success:переданы не все параметры}';
		exit;
	}




}