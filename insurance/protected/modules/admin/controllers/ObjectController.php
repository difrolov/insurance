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

	//показываем разделы приоритет
	public function actionPriorityObject(){

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
			$sql = 'SELECT ob.*
					FROM insur_insurance_object as ob
					LEFT JOIN order_by_menu as orm ON orm.id_object=ob.id
					WHERE ob.parent_id='.$object->parent_id.' and
							ob.status=1
					ORDER BY orm.priority';
			$gridDataProvider = Yii::app()->db->createCommand($sql)->queryAll();
			$this->render('priority',array(/* 'obj'=>$obj,'child_obj'=>$child_obj, */'gridDataProvider'=>$gridDataProvider));
		}
	}
	//меняем разделы местами
	public function actionPriority(){
		if(isset($_POST['id'])){
			if($_POST['type']=='up'){
				$this_ob = InsurOrderMenu::model()->find(array('condition'=>'id_object='.$_POST['id']));
				if($this_ob->priority==1){
					echo json_encode(array('error'=>'этот элемент верхний в списке'));
					exit;
				}
				//$prev_ob = InsurOrderMenu::model()->findAll(array('condition'=>'parent_id='.$this_ob->parent_id.' and priority='.$this_ob->priority-1));
				$sql = 'SELECT *
						FROM order_by_menu
						WHERE parent_id='.$this_ob->parent_id.' and priority="'.($this_ob->priority-1).'"';
				$prev_ob = Yii::app()->db->createCommand($sql)->queryAll();
				InsurOrderMenu::model()->updateAll(array('priority' => $this_ob->priority-1),array('condition'=>'id_object = "'.$_POST['id'].'"'));
				InsurOrderMenu::model()->updateAll(array('priority' => ($prev_ob[0]['priority']+1)),array('condition'=>'id_object = "'.$prev_ob[0]['id_object'].'"'));
				echo json_encode(array('success'=>'Изменения внесены'));
				exit;
			}else{
				$this_ob = InsurOrderMenu::model()->find(array('condition'=>'id_object='.$_POST['id']));
				$sql = 'SELECT *
				FROM order_by_menu
				WHERE parent_id='.$this_ob->parent_id.' and priority="'.($this_ob->priority+1).'"';
				$next_ob = Yii::app()->db->createCommand($sql)->queryAll();

				if(count($next_ob)>0){
					InsurOrderMenu::model()->updateAll(array('priority' => $this_ob->priority+1),array('condition'=>'id_object = "'.$_POST['id'].'"'));
					InsurOrderMenu::model()->updateAll(array('priority' => ($next_ob[0]['priority']-1)),array('condition'=>'id_object = "'.$next_ob[0]['id_object'].'"'));
					echo json_encode(array('success'=>'Изменения внесены'));
					exit;
				}else{
					echo json_encode(array('error'=>'этот элемент последний в списке'));
					exit;
				}
			}
		}
	}

	//удаляем раздел
	// ** метод также может быть вызван методом $this->actionRemove(), в случае, если запрос поступает со страницы предпросмотра нового подраздела. В этом случае id приходит в виде аргумента от вызывающего метода; в противном случае, как и раньше - с $_GET['id']
	public function actionDelete($section_id=false){
		if(!Yii::app()->user->checkAccess('admin')){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
		}
		if (!$id=$section_id)
			if (isset($_GET['id'])) $id=$_GET['id'];
		if($id){
			$model = InsurInsuranceObject::model()->find(array('condition'=>"id=".$id));
			if(isset($model->name)){
				$model->delete();
			}
		}
		return true;
	}
	public function actionRemove($section_id=false){
		echo ($this->actionDelete($section_id))? "Подраздел удалён.":"ОШИБКА! Подраздел не был удалён...";
		exit;
	}


	public function actionUpdateStatus(){
		if(!Yii::app()->user->checkAccess('admin') || Yii::app()->user->isGuest){
			Yii::app()->request->redirect(Yii::app()->createUrl('user/login'));
			echo json_encode(array('success'=>'не хватает прав'));
			exit;
		}
		if(isset($_POST['status']) && isset($_POST['id'])){
			$query = InsurInsuranceObject::model()->find(array('condition'=>'id in ('.$_POST['id'].')'));
			$query->status = $_POST['status'];
			$query->save();
			echo json_encode(array('success'=>1));
			exit;
		}
		echo json_encode(array('success'=>'переданы не все параметры'));
		exit;;
	}




}