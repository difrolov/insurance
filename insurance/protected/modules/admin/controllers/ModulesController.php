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
			if(isset($_GET['id'])){
				$model=InsurJobs::model()->findByPk($_GET['id']);
			}
			$model->attributes = $_POST['InsurJobs'];
			$model->creat_date = date("Y-m-d H:i:s");
			$model->save();
		}elseif(isset($_GET['id'])){
			$model = InsurJobs::model()->findByPk($_GET['id']);

		}
		$this->render('jobs',array('model'=>$model));
	}
	public function actionGetJobs(){
		$gridDataProvider = action::getJobs(false,true);
		$this->render('getjobs',array('gridDataProvider'=>$gridDataProvider));
	}
	public function actionUpdateStatusJobs(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
			echo json_encode(array('success'=>'не хватает прав'));
			exit;
		}
		if(isset($_POST['status']) && isset($_POST['id'])){
			$query = InsurJobs::model()->find(array('condition'=>'id in ('.$_POST['id'].')'));
			$query->status = $_POST['status'];
			$query->save();
			echo json_encode(array('success'=>1));
			exit;
		}
		echo json_encode(array('success'=>'переданы не все параметры'));
		exit;

	}
	//удаляем вакансию
	public function actionDelete(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		if(isset($_GET['id'])){
			$model = InsurJobs::model()->find(array('condition'=>"id=".$_GET['id']));
			if(isset($model->id)){
				$model->delete();
			}
			$model = new InsurJobs();
			$gridDataProvider = $model->search();
			$this->render('getjobs',array('gridDataProvider'=>$gridDataProvider));
		}

	}

	public function actionContacts(){
		$model = new InsurContacts();
		$modelRegion = new InsurRegion();
		if(isset($_POST['InsurContacts'])){
			if(isset($_GET['id'])){
				$model=InsurContacts::model()->findByPk($_GET['id']);
			}
			$model->attributes = $_POST['InsurContacts'];
			if(isset($_POST['name'])){
				$model->region=$_POST['name'];
			}
			$model->create_date = date("Y-m-d H:i:s");
			$model->save();
		}elseif(isset($_GET['id'])){
			$model = InsurContacts::model()->findByPk($_GET['id']);

		}
		Yii::import('application.extensions.gmap3.*');
		/* $gmap = new EGmap3Widget();
		$options = array(
				'scaleControl' => true,
				'streetViewControl' => false,
				'zoom' => 1,
				'center' => array(0,0),
				'mapTypeId' => EGmap3MapTypeId::HYBRID,
				'mapTypeControlOptions' => array(
						'style' => EGmap3MapTypeControlStyle::DROPDOWN_MENU,
						'position' => EGmap3ControlPosition::TOP_CENTER,
				),
				'zoomControlOptions' => array(
						'style' => EGmap3ZoomControlStyle::SMALL,
						'position' => EGmap3ControlPosition::BOTTOM_CENTER
				),
		);
		$gmap->setOptions($options);
		$address = new InsurContacts();

		// init the map
		$gmap = new EGmap3Widget();
		$gmap->setOptions(array('zoom' => 14));
 */		$this->render('contacts',array('model'=>$model,/* 'gmap'=>$gmap, */'modelRegion'=>$modelRegion));
	}
	public function actionGetContacts(){
		$gridDataProvider = action::getContacts(false,true);
		$this->render('getContacts',array('gridDataProvider'=>$gridDataProvider));
	}
	public function actionUpdateStatusContacts(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
			echo json_encode(array('success'=>'не хватает прав'));
			exit;
		}
		if(isset($_POST['status']) && isset($_POST['id'])){
			$query = InsurContacts::model()->find(array('condition'=>'id in ('.$_POST['id'].')'));
			$query->status = $_POST['status'];
			$query->save();
			echo json_encode(array('success'=>1));
			exit;
		}
		echo json_encode(array('success'=>'переданы не все параметры'));
		exit;

	}
	//удаляем вакансию
	public function actionDeleteContacts(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		if(isset($_GET['id'])){
			$model = InsurContacts::model()->find(array('condition'=>"id=".$_GET['id']));
			if(isset($model->id)){
				$model->delete();
			}
			$model = new InsurContacts();
			$gridDataProvider = $model->search();
			$this->render('getcontacts',array('gridDataProvider'=>$gridDataProvider));
		}

	}

}
