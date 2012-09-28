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
			if(empty($object)){
				$this->redirect('index');
			}
			//собираем данные об объекте
			foreach($object as $key=>$value){
				$obj[$key] = $value;
			}
			//достаем из быза все что относится к объекту
			$chidren = InsurInsuranceObject::model()->findAll(array('condition'=>'parent_id='.$_GET['id']));
			foreach($chidren as $child){
				$child_obj['id'] = $child->id;
				$child_obj['name'] = $child->name;
				$child_obj['status'] = $child->status;
				$child_obj['parend_id'] = $child->parent_id;
				$child_obj['alias'] = $child->alias;
				$child_obj['category_id'] = $child->category_id;
			}
			//таблица для отображения
			/* $gridDataProvider = new CArrayDataProvider(array(
					$obj,
					$child_obj
			)); */
			$model = new InsurInsuranceObject();
			/* var_dump($model->search('id='.$_GET['id'].' OR parent_id='.$_GET['id'])); */
			$gridDataProvider = $model->search('id='.$_GET['id'].' OR parent_id='.$_GET['id']);
			$this->render('getobject',array('obj'=>$obj,'child_obj'=>$child_obj,'gridDataProvider'=>$gridDataProvider));
		}
	}
}