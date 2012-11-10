<?php

class GeneratorController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		$model = new InsurArticleContent;
		$sql = "SELECT o.`name`,o.`status`,o.`parent_id`,o.`alias`,m.id
				FROM insur_modules as m
				LEFT JOIN insur_insurance_object as o ON o.`id`=m.`object_id`
				WHERE o.`status`= 1";
		$model_modules = Yii::app()->db->createCommand($sql)->queryAll();
		$this->render('index',array('model'=>$model,'model_modules'=>$model_modules));
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

	//
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
		die('Edit mode');
		
		if(isset($_GET['id'])){
		
		}
	}
	
	public function actionSave(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		/*
		action: /insur/insurance/admin/generator/save
		JSON:
		{
			"Schema":"4ss",
			
			"blocks":{
				"1":"Новость|Текст :: Статеюшка такая!^<p>\n\tGринцип нарушен, что человек, попадающий в другую эпоху, другое время, все равно остается самим собой. Но мне кажется этот прием работает на то, чтобы доказать то, что мы обычно любим говорить, вот если бы я был бы тогда, я бы сделал...</p>\n|Новость",
				"2":"header:Подзаголовок такой подзаголовок!",
				"3":"Готовое решение 1",
				"4":"Готовое решение 1",
				"5":"Готовое решение 2",
				"footer":"Готовое решение 2|Текст",
				"activeBlockIdentifier":1,
				"moduleClickedLocalIndex":1
			},
			
			"parent":"4",
			
			"alias":"myarticle",
			
			"title":"Про всякие дела",
			
			"keywords":"статья мессага",
			
			"description":"Описание будет позже. Обязательно!"
		}
		*/
		echo json_encode(array( "result"=>"Подраздел создан!"));
	}
}