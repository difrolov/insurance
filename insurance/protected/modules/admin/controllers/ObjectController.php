<?php
class ObjectController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex()
	{

		$this->render('index');
	}

	public function actionGetObject(){

		if(!Yii::app()->user->checkAccess('admin')){
	    	Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_GET['id'])){ 
			//достаём объект из базы
			$object = InsurInsuranceObject::model()->findByPk($_GET['id']);
			if(!$object){
				$this->redirect('index');
			}
						//таблица для отображения
			$model = new InsurInsuranceObject();

			$gridDataProvider['parent'] = $model->search('id='.$_GET['id']);
			$gridDataProvider['child'] = $model->search('parent_id='.$_GET['id']);
			$this->render('getobject',array(/* 'obj'=>$obj,'child_obj'=>$child_obj, */'gridDataProvider'=>$gridDataProvider));
		}
	}


	//удаляем раздел
	public function actionDelete(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		if(isset($_GET['id'])){
			$model = InsurInsuranceObject::model()->find(array('condition'=>"id=".$_GET['id']));
			if(isset($model->name)){
				$model->delete();
			}
		}
	}
}