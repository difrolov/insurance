<?php
class BannerController extends Controller{
	public $layout = "application.modules.admin.views.layouts.banner";

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
		$gridDataProvider_out = $model->search('place="outside"',true);
		$gridDataProvider_in = $model->search('place="inside"',true);
		$gridDataProvider_3 = $model->search('place="3"',true);
		$gridDataProvider_4 = $model->search('place="4"',true);
		$out_query = InsurBanners::model()->findAll(array('condition'=>'place="outside"'));
		$in_query = InsurBanners::model()->findAll(array('condition'=>'place="inside"'));
		$this->render('getbanner',array('in'=>$gridDataProvider_in,'out'=>$gridDataProvider_out,
										'ban3'=>$gridDataProvider_3,
										'ban4'=>$gridDataProvider_4,
										'out_query'=>$out_query,'in_query'=>$in_query));
	}
	public function actionAjaxUpdate(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
			exit;
		}
		if(isset($_POST['id']) && isset($_POST['field']) && isset($_POST['val'])){
			$query = InsurBanners::model()->find(array('condition'=>'id='.$_POST['id']));
			if($_POST['field'] == "link"){
				$sql = InsurInsuranceObject::model()->find(array('condition'=>'id='.$_POST['val']));
				$_POST['val'] = $sql->alias;
			}
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
	//меняем статус банера
	public function actionAjaxUpdateStatus(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
			exit;
		}
		if(isset($_POST['ban']) && isset($_POST['val']) && isset($_POST['id'])){
				$query = InsurBanners::model()->findAll(array('condition'=>'id in ('.$_POST['id'].')'));
				foreach($query as $key=>$val){
					$query[$key]->status = $_POST['val'];
					$query[$key]->save();
				}


			echo json_encode(array('success'=>1));
			exit;
		}
		echo json_encode(array('success'=>'переданы не все параметры'));
		exit;;
	}
	//добавляем банеры
	public function actionAddBaner(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_GET['set'])){
			if($_GET['set']=="out"){
				$model = new InsurBanners();
				$model->name="банер1";
				$model->status = 0;
				$model->place = 'outside';
				$model->date_edit = date('Y-m-d H:i:s');
				$model->save();
			}
		}
		$this->redirect(Yii::app()->createUrl('admin/banner/getbanner'));
	}



}