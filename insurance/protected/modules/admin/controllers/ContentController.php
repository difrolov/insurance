<?php
class ContentController extends Controller
{
	public $layout = "application.modules.admin.views.layouts.admin";

	public function actionIndex()
	{

		$this->render('index');
	}

	//отображаем статьи
	public function actionGetContent(){

		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		$model = new InsurArticleContent();
		//фильтр по таблице
		if(isset($_GET['InsurArticleContent'])){
			if(isset($_GET['InsurArticleContent']['id']) && $_GET['InsurArticleContent']['id']!=""){
				$gridDataProvider = $model->search("id=".$_GET['InsurArticleContent']['id']);
			}elseif(isset($_GET['InsurArticleContent']['name']) && $_GET['InsurArticleContent']['name']!=""){
				$gridDataProvider = $model->search("name='".$_GET['InsurArticleContent']['name']."'");
			}
			return $this->widget('application.extensions.bootstrap.widgets.TbGridView', array(
				    'type'=>'striped bordered condensed',
				    'dataProvider'=>$gridDataProvider,
				    'template'=>"{items}{pager}",
				 	'filter'=>$model,
				    'columns'=>array(
				       	array('name'=>'id', 'header'=>'#'),
				        array('name'=>'name', 'header'=>'Наименование'),
				       /*  array('name'=>'created', 'header'=>'Дата изменения'),
				    	array('name'=>'status', 'header'=>'Видимость'), */

				        array(
				            'class'=>'application.extensions.bootstrap.widgets.TbButtonColumn',
				            'htmlOptions'=>array('style'=>'width: 50px'),
				        	'template'=>'{update}{delete}',
				        	'buttons'=>array(
				        				'update' => array(
				        						'url'=>'Yii::app()->createUrl("admin/content/edit", array("id"=>$data[\'id\']))',
				        				),
				        		),
				        ),
				    ),
				));
		}
		if(isset($_GET['id'])){
			//Достаем контент страницы
			$content = InsurArticleContent::model()->findAll(array('condition'=>"object_id=".$_GET['id']));
			if(!$content){
				$this->redirect('index');
			}
			//таблица для отображения
			$gridDataProvider = $model->search('object_id='.$_GET['id']);
			$this->render('GetContent',array('gridDataProvider'=>$gridDataProvider,'model'=>$model));
		}else{
			$gridDataProvider = $model->search();
			$this->render('GetContent',array('gridDataProvider'=>$gridDataProvider,'model'=>$model));
		}
	}

	public function actionEdit(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if(isset($_POST['InsurArticleContent'])){
			$model = InsurArticleContent::model()->find(array('condition'=>"id=".$_GET['id']));
			if(isset($model->content)){
				$model->content = $_POST['InsurArticleContent']['content'];
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
	//удаляем раздел
	public function actionDelete(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}

		if(isset($_GET['id'])){
			$model = InsurArticleContent::model()->find(array('condition'=>"id=".$_GET['id']));
			if(isset($model->content)){
				$model->status = 0;
				$model->save();
			}
		}
	}
	public function actionSetContent(){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if (isset($_POST['InsurArticleContent'])){
			$model = new InsurArticleContent;
			$model->content = $_POST['InsurArticleContent']['content'];
			$model->created = date("Y-m-d h:i:s");
			$model->status = 1;
			$model->name = @$_POST['name_content'];
			$model->insur_coworkers_id = Yii::app()->user->id;
			$model->object_id = @$_POST['object_id'];
			$model->save();
			$this->redirect('Update/'.$_POST['object_id']);
		}
	}


}