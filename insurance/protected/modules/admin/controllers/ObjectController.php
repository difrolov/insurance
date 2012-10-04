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

	//отображаем статьи
	public function actionUpdate(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_GET['id'])){
			//Достаем контент страницы
			$content = InsurArticleContent::model()->findAll(array('condition'=>"object_id=".$_GET['id']));
			if(!$content){
				$this->redirect('index');
			}
			//таблица для отображения
			$model = new InsurArticleContent();
			$gridDataProvider = $model->search('object_id='.$_GET['id']);
			$this->render('update',array('gridDataProvider'=>$gridDataProvider));
		}
	}

	public function actionEdit(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_POST['InsurArticleContent'])){
			$model = InsurArticleContent::model()->findByPk($_GET['id']);
			if(isset($model[0]->content)){
				$model[0]->content = $_POST['InsurArticleContent']['content'];
				$model->save();
			}
		}
		if(isset($_GET['id'])){
			//Достаем контент страницы
			$content = InsurArticleContent::model()->findAll(array('condition'=>"id=".$_GET['id']));
			if(!$content){
				$this->redirect('index');
			}
			//таблица для отображения

			$this->render('edit',array('model'=>$content,'id_content'=>$_GET['id']));
		}
	}


}